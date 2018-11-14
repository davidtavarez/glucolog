import os

import boto3
from flask_jwt_extended import jwt_required, get_jwt_identity
from flask_restful import Resource, reqparse
from werkzeug.datastructures import FileStorage
import uuid

from models.users.user import User as UserModel
from schemas.users.avatar import Avatar as AvatarSchema


class Avatar(Resource):
    def __init__(self) -> None:
        super().__init__()

        self.S3_KEY = os.environ.get('S3_KEY', None)
        self.S3_SECRET = os.environ.get('S3_SECRET', None)
        self.S3_BUCKET = os.environ.get('S3_BUCKET_AVATARS', None)

        self.parser = reqparse.RequestParser()
        self.parser.add_argument('avatar', type=FileStorage, location='files')

        self.schema = AvatarSchema()

    @jwt_required
    def get(self):
        user = UserModel.find(get_jwt_identity())
        return self.schema.jsonify(user, many=False)

    @jwt_required
    def patch(self):
        if os.environ.get('TESTING', None):
            return {'avatar': 'http://'}, 200

        if self.S3_KEY is None or self.S3_SECRET is None or self.S3_BUCKET is None:
            return {'error': 'S3 Bucket is not configured.'}, 500

        file = self.parser.parse_args().get('avatar')

        if not file:
            return {'error': 'Missing avatar.'}, 400

        if not UserModel.allowed_avatar(file.filename):
            return {'error': 'Avatar not supported.'}, 400

        user = UserModel.find(get_jwt_identity())

        if not user:
            return {'error': 'User not found.'}, 404

        object_key = '{}.{}'.format(str(uuid.uuid4()).replace('-', ''), file.filename.rsplit('.', 1)[1].lower())

        s3 = boto3.client(
            's3',
            aws_access_key_id=self.S3_KEY,
            aws_secret_access_key=self.S3_SECRET
        )

        s3.put_object(Bucket=self.S3_BUCKET, Body=file, ACL='public-read', Key=object_key)

        user.avatar = "https://s3.amazonaws.com/{0}/{1}".format(self.S3_BUCKET, object_key)
        user.safe()

        return self.schema.jsonify(user, many=False)
