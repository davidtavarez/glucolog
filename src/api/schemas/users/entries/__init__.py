from marshmallow import fields

from schemas import Resource
from schemas.users.user import User


class Entry(Resource):
    takenAt = fields.DateTime()
