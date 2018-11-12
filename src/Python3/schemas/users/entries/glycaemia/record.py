from marshmallow import fields

from schemas.utils.state import State
from schemas.users.entries import Entry


class Record(Entry):
    value = fields.Integer()
    time = fields.Time()
    state = fields.Nested(State, only=['description'], many=False, dump_only=True)
    comment = fields.String()

    class Meta:
        strict = True
