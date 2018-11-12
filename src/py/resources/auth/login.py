from models.users.user import User as UserModel
from resources.auth import Authentication
from schemas.users.user import User as UserSchema

from flask_jwt_extended import create_access_token


class Login(Authentication):
    def __init__(self) -> None:
        super().__init__()
        self.parser.add_argument('email')
        self.parser.add_argument('password')

        self.schema = UserSchema()

    def post(self):
        data = self.parser.parse_args()
        user = UserModel.login(data['email'], data['password'])
        if user:
            return {'jwt': create_access_token(identity=user.email, expires_delta=False)}, 200
        return {'error': 'Wrong credentials'}, 404
