from marshmallow import fields

from schemas import Resource


class Read(Resource):
    name = fields.String()
    value = fields.String()
