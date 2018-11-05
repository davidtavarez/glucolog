from marshmallow import fields

from schemas.utils.state import State
from schemas.users.entries import Entry


class Glycemia(Entry):
    value = fields.Integer()
    time = fields.Time()
    state = fields.Nested(State)
    comment = fields.String()
    picture = fields.Url()
