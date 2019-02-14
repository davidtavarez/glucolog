from marshmallow import fields

from schemas.utils.state import State
from schemas.users.entries import Entry


class Food(Entry):
    value = fields.Integer()
    time = fields.Time()

    class Meta:
        strict = True
