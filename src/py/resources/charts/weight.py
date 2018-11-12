from flask_restful import Resource, reqparse

from models.users.entries.weight.record import Record as WeightModel
from schemas.users.entries.weight.record import Record as WeightSchema

from models.users.user import User as UserModel


class WeightData(Resource):
    def __init__(self) -> None:
        super().__init__()

        self.parser = reqparse.RequestParser()
        self.parser.add_argument('username')
        self.parser.add_argument('key')

        self.schema = WeightSchema()

    def post(self):
        data = self.parser.parse_args()

        username = data.get('username', None)
        key = data.get('key', None)

        if not username or not key:
            return {'error': 'Invalid request.'}, 400

        user = UserModel.findByKeys(username, key)

        if not user:
            return {'error': 'Invalid keys.'}, 403

        return self.schema.jsonify(WeightModel.findByUserId(user.id), many=True)
