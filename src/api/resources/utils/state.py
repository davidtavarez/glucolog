from flask_restful import Resource
from models.utils.state import State as StateModel
from schemas.utils.state import State as StateSchema


class States(Resource):
    def __init__(self) -> None:
        super().__init__()
        self.schema = StateSchema()

    def get(self):
        return self.schema.jsonify(StateModel.query.all(), many=True)
