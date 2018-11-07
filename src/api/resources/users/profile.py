import datetime

from flask_jwt_extended import jwt_required, get_jwt_identity
from flask_restful import Resource, reqparse

from models.users.user import User as UserModel
from schemas.users.user import User as UserSchema


class Profile(Resource):
    def __init__(self) -> None:
        super().__init__()
        self.parser = reqparse.RequestParser()
        self.parser.add_argument('name')
        self.parser.add_argument('email')
        self.parser.add_argument('password')
        self.parser.add_argument('birthday')
        self.parser.add_argument('sex')
        self.parser.add_argument('diabetes')
        self.parser.add_argument('detection')

        self.schema = UserSchema()

    @jwt_required
    def get(self):
        return self.schema.jsonify(UserModel.find(get_jwt_identity()), many=False)

    @jwt_required
    def patch(self):
        text_fields = ['name', 'sex', 'diabetes']
        date_fields = ['birthday', 'detection']

        user = UserModel.find(get_jwt_identity())
        data = self.parser.parse_args()

        for field in data:
            value = data.get(field, None)
            if value is not None and (field in date_fields or field in text_fields):
                if field in date_fields:
                    value = datetime.datetime.strptime(value, "%Y-%m-%d").date()
                setattr(user, field, value)

        user.safe()

        return self.schema.jsonify(user, many=False)
