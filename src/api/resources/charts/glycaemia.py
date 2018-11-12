from flask_restful import Resource, reqparse

from models.users.entries.glycaemia.record import Record as GlycaemiaModel
from schemas.users.entries.glycaemia.record import Record as GlycaemiaSchema

from models.users.user import User as UserModel


class GlycaemiaData(Resource):
    def __init__(self) -> None:
        super().__init__()

        self.parser = reqparse.RequestParser()
        self.parser.add_argument('username')
        self.parser.add_argument('key')

        self.schema = GlycaemiaSchema()

    def post(self):
        data = self.parser.parse_args()

        username = data.get('username', None)
        key = data.get('key', None)

        if not username or not key:
            return {'error': 'Invalid request.'}, 400

        user = UserModel.findByKeys(username, key)

        if not user:
            return {'error': 'Invalid keys.'}, 403

        return self.schema.jsonify(GlycaemiaModel.findByUserId(user.id), many=True)
