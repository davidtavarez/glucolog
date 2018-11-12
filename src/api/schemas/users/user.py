from marshmallow import fields

from schemas import Resource


class User(Resource):
    name = fields.String()
    email = fields.String()
    birthday = fields.Date()
    diabetes = fields.String()
    detection = fields.Date()
    sex = fields.String()
    avatar = fields.Url()
