from models import db
from models.utils.state import State
from models.users.entries import Entry


class Glycemia(Entry, db.Model):
    value = db.Column(db.Integer, nullable=False,)
    state = db.Column(db.ForeignKey(State), nullable=False)
    picture =db.ColumnO(db.FileField(), nullable=True)
    comment = db.Column(db.String(250), nullable=True)
