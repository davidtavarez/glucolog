from marshmallow import fields

from schemas.users.entries import Entry


class Record(Entry):
    value = fields.Integer()
