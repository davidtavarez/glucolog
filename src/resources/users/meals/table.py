from flask_jwt_extended import jwt_required, get_jwt_identity
from flask_restful import Resource, reqparse

from models.users.entries.meal.record import Record as MealModel
from schemas.users.entries.meal.record import Record as MealSchema

from models.users.user import User as UserModel


class MealTable(Resource):
    def __init__(self) -> None:
        super().__init__()
        self.parser = reqparse.RequestParser()
        self.parser.add_argument('username')
        self.schema = MealSchema()

    @jwt_required
    def get(self):
        user = get_jwt_identity()
        return self.schema.jsonify(MealModel.findByUserEmail(user), many=True)

    @jwt_required
    def post(self):
        user_email = get_jwt_identity()
        data = self.parser.parse_args()

        name = data.get('username', None)
        if not name:
            return {'error': "Invalid request."}, 400

        user = UserModel.find(user_email).id

        key = MealModel(user)
        key.value = MealModel.generateKey()
        key.username = name

        key.safe()

        return self.schema.jsonify(key, many=False)
