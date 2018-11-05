from models import db
from models.users.entries import Entry


class Weight(Entry, db.Model):
    __tablename__ = 'user_weight_records'
    value = db.Column(db.Integer, nullable=False)
