import os

import boto3
from flask_jwt_extended import jwt_required
from flask_restful import Resource, reqparse
from werkzeug.datastructures import FileStorage
import uuid

from models.users.entries.glycaemia.photo import Photo as GlycaemiaPhotoModel
from schemas.users.entries.glycaemia.photo import Photo as GlycaemiaPhotoSchema


class GlycaemiaPhoto(Resource):
    def __init__(self) -> None:
        super().__init__()

        self.S3_KEY = os.environ.get('S3_KEY', None)
        self.S3_SECRET = os.environ.get('S3_SECRET', None)
        self.S3_BUCKET = os.environ.get('S3_BUCKET_GLYCEAMIA_RECORDS_PHOTOS', None)

        self.parser = reqparse.RequestParser()
        self.parser.add_argument('photo', type=FileStorage, location='files')

        self.schema = GlycaemiaPhotoSchema()

    @jwt_required
    def get(self, id):
        photo = GlycaemiaPhotoModel.getByRecordId(id)
        if photo:
            return self.schema.jsonify(photo, many=False)
        return {'error', "Record don't have a photo.", 404}

    @jwt_required
    def delete(self, id):
        if GlycaemiaPhotoModel.deleteByRecordId(id):
            return {}, 204
        return {'error': 'Record not found'}, 404

    @jwt_required
    def post(self, id):
        if os.environ.get('TESTING', None):
            return {'url': 'http://'}, 200

        if self.S3_KEY is None or self.S3_SECRET is None or self.S3_BUCKET is None:
            return {'error': 'S3 Bucket is not configured.'}, 500

        file = self.parser.parse_args().get('photo')

        if not file:
            return {'error': 'Missing photo.'}, 400

        if not GlycaemiaPhotoModel.allowed_photo(file.filename):
            return {'error': 'Photo not supported.'}, 400

        photo = GlycaemiaPhotoModel.getByRecordId(id)

        if not photo:
            return {'error': 'Record not found.'}, 404

        object_key = '{}.{}'.format(str(uuid.uuid4()).replace('-', ''), file.filename.rsplit('.', 1)[1].lower())

        s3 = boto3.client(
            's3',
            aws_access_key_id=self.S3_KEY,
            aws_secret_access_key=self.S3_SECRET
        )

        s3.put_object(Bucket=self.S3_BUCKET, Body=file, ACL='public-read', Key=object_key)

        photo.url = "https://s3.amazonaws.com/{0}/{1}".format(self.S3_BUCKET, object_key)
        photo.safe()

        return self.schema.jsonify(photo, many=False)
