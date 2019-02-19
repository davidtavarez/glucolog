from flask_jwt_extended import jwt_required
from flask_restful import Resource, reqparse

from models.users.entries.weight.record import Record as WeightModel
from schemas.users.entries.weight.record import Record as WeightSchema


class WeightRecord(Resource):
    def __init__(self) -> None:
        super().__init__()

        self.parser = reqparse.RequestParser()
        self.parser.add_argument('value')

        self.schema = WeightSchema()

    @jwt_required
    def get(self, id):
        return self.schema.jsonify(WeightModel.getById(id))

    @jwt_required
    def post(self, id):
        data = self.parser.parse_args()
        record = WeightModel.getById(id)

        value = data.get('value', None)
        if not value:
            return {'error': 'Invalid request.'}, 400

        record.value = value
        record.safe()

        return self.schema.jsonify(WeightModel.getById(id))

    @jwt_required
    def delete(self, id):
        if WeightModel.deleteById(id):
            return {}, 204
        return {'error': 'Record not found'}, 404
