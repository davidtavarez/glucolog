from marshmallow import fields

from schemas.utils.state import State
from schemas.users.entries import Entry


class Glycaemia(Entry):
    value = fields.Integer()
    time = fields.Time()
    state = fields.Nested(State)
    comment = fields.String()
