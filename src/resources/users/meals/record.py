from flask_jwt_extended import jwt_required
from flask_restful import Resource, reqparse

from models.users.entries.meal.record import Record as MealModel
from schemas.users.entries.meal.record import Record as MealSchema


class MealRecord(Resource):
    def __init__(self) -> None:
        super().__init__()

        self.parser = reqparse.RequestParser()
        self.parser.add_argument('food')
        self.parser.add_argument('type')

        self.schema = MealSchema()

    @jwt_required
    def get(self, id:int):
        return self.schema.jsonify(MealModel.getById(id))


    @jwt_required
    def delete(self, id):
        if MealModel.deleteById(id):
            return {}, 204
        return {'error': 'Record not found'}, 404
