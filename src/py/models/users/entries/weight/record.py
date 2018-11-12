from sqlalchemy import desc

from models import db
from models.users.entries import Entry
from models.users.user import User


class Record(Entry, db.Model):
    def __init__(self, user_id) -> None:
        super().__init__()
        self.user_id = user_id

    __tablename__ = 'weight_record'

    user_id = db.Column(db.Integer, db.ForeignKey('{}.id'.format(User.__tablename__)), nullable=False)
    value = db.Column(db.Integer, nullable=False)

    @classmethod
    def findByUserEmail(cls, email):
        return cls.query.join(User).filter(User.email == email).order_by(desc(Record.takenAt)).all()

    @classmethod
    def findByUserId(cls, user_id):
        return cls.query.filter_by(user_id=user_id).order_by(desc(Record.takenAt)).all()

    @classmethod
    def getById(cls, id):
        return cls.query.filter_by(id=id).first()

    @classmethod
    def deleteById(cls, id):
        return cls.query.filter_by(id=id).delete()
