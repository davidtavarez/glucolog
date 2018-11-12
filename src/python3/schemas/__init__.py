from flask_marshmallow import Marshmallow
from marshmallow import fields

ma = Marshmallow()


class Resource(ma.Schema):
    id = fields.String(dump_only=True)
    createdAt = fields.DateTime()
    updatedAt = fields.DateTime()

