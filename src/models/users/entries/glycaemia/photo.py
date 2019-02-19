from models import db
from models.users.entries import EntryPhoto
from models.users.entries.glycaemia.record import Record


class Photo(EntryPhoto, db.Model):
    __tablename__ = 'glycaemia_record_photo'
    record = db.Column(db.Integer, db.ForeignKey('{}.id'.format(Record.__tablename__)), nullable=False)
