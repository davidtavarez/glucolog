from flask_jwt_extended import jwt_required
from flask_restful import Resource

from models.users.keys.read import Read as KeyModel
from schemas.users.keys.read import Read as KeySchema


class KeyRecord(Resource):
    def __init__(self) -> None:
        super().__init__()

        self.schema = KeySchema()

    @jwt_required
    def delete(self, id):
        if KeyModel.deleteById(id):
            return {}, 204
        return {'error': 'Record not found'}, 404
