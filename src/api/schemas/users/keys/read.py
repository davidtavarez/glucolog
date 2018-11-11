from marshmallow import fields

from schemas import Resource


class Read(Resource):
    username = fields.String()
    value = fields.String()
