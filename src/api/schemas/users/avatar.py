from marshmallow import fields

from schemas import ma


class Avatar(ma.Schema):
    avatar = fields.String()
