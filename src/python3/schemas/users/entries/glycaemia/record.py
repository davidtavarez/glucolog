from marshmallow import fields

from schemas.utils.state import State
from schemas.users.entries import Entry
from schemas.users.entries.glycaemia.food import Food


class Record(Entry):
    value = fields.Integer()
    time = fields.Time()
    state = fields.Nested(State, only=['description'], many=False, dump_only=True)
    foods = fields.Nested(Food, many=True)
    comment = fields.String()

    class Meta:
        strict = True
