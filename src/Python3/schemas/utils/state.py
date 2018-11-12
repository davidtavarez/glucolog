from marshmallow import fields

from schemas import Resource


class State(Resource):
    description = fields.String()