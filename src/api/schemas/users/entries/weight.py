from marshmallow import fields

from schemas.users.entries import Entry


class Weight(Entry):
    value = fields.Integer()
