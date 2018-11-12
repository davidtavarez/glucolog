from flask_jwt_extended import jwt_required, get_jwt_identity
from flask_restful import Resource

from models.users.entries.weight.record import Record as WeightModel
from schemas.users.entries.weight.record import Record as WeightSchema


class WeightTable(Resource):
    def __init__(self) -> None:
        super().__init__()

        self.schema = WeightSchema()

    @jwt_required
    def get(self):
        user = get_jwt_identity()
        return self.schema.jsonify(WeightModel.findByUserEmail(user), many=True)
