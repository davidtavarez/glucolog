from flask_jwt_extended import jwt_required, get_jwt_identity
from flask_restful import Resource

from models.users.entries.glycaemia.record import Record as GlycaemiaModel
from schemas.users.entries.glycaemia.record import Record as GlycaemiaSchema


class GlycaemiaTable(Resource):
    def __init__(self) -> None:
        super().__init__()

        self.schema = GlycaemiaSchema()

    @jwt_required
    def get(self):
        user = get_jwt_identity()
        return self.schema.jsonify(GlycaemiaModel.findByUserEmail(user), many=True)
