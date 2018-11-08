import os

from flask_jwt_extended import jwt_required, get_jwt_identity
from flask_restful import Resource, reqparse
from werkzeug.datastructures import FileStorage
from werkzeug.utils import secure_filename

from models.users.user import User as UserModel
from schemas.users.avatar import Avatar as AvatarSchema


class Avatar(Resource):
    def __init__(self) -> None:
        super().__init__()
        self.parser = reqparse.RequestParser()
        self.parser.add_argument('avatar', type=FileStorage, location='files')

        self.schema = AvatarSchema()

    @jwt_required
    def get(self):
        return self.schema.jsonify(UserModel.find_avatar(get_jwt_identity()), many=False)

    @jwt_required
    def patch(self):
        user = UserModel.find(get_jwt_identity())

        data = self.parser.parse_args()

        file = data.get('avatar')

        if file and UserModel.allowed_avater(file.filename):
            filename = secure_filename(file.filename)
            file.save(os.path.join('/Users/davidtavarez/Projects/glucolog/src/api/uploads/', filename))

        return self.schema.jsonify(user, many=False)
