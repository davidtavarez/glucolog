import datetime

from flask_jwt_extended import create_access_token
from flask_restful import reqparse

from models.users.user import User as UserModel
from resources.auth import Authentication
from schemas.users.user import User as UserSchema


class Register(Authentication):
    def __init__(self) -> None:
        super().__init__()
        self.parser.add_argument('name')
        self.parser.add_argument('email')
        self.parser.add_argument('password')
        self.parser.add_argument('birthday')
        self.parser.add_argument('sex')
        self.parser.add_argument('diabetes')
        self.parser.add_argument('detection')

        self.schema = UserSchema()

    def post(self):

        data = self.parser.parse_args()

        user = UserModel(data.get('email'), data.get('email'))
        user.name = data.get('name')
        user.password = data.get('password')
        user.birthday = datetime.datetime.strptime(data.get('birthday'), "%Y-%m-%d").date()
        user.detection = datetime.datetime.strptime(data.get('detection'), "%Y-%m-%d").date()
        user.sex = data.get('sex')
        user.diabetes = data.get('diabetes')

        try:
            user.safe()
            return {'jwt': create_access_token(identity=user.email, expires_delta=False)}, 201
        except Exception as e:
            return {'error': str(e)}, 422
