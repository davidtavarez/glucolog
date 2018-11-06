from flask_jwt_extended import jwt_required, get_jwt_identity
from flask_restful import Resource
from models.users.user import User as UserModel
from schemas.users.user import User as UserSchema

class Profile(Resource):
    def __init__(self) -> None:
        super().__init__()
        self.schema = UserSchema()

    @jwt_required
    def get(self):
        email = get_jwt_identity()
        return self.schema.jsonify(UserModel.find(email), many=False)
