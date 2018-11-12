from marshmallow import fields

from schemas import ma


class Photo(ma.Schema):
    url = fields.String()
