from marshmallow import fields

from schemas import Resource


class Avatar(Resource):
    avatar = fields.String()
