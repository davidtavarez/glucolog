from marshmallow import fields

from schemas.users.entries import Entry


class Record(Entry):
    value = fields.Integer()
    comment = fields.String()

    class Meta:
        strict = True
