from models import db
from models.users.entries import Entry
from models.users.user import User
from models.utils.state import State
from sqlalchemy import desc


class Record(Entry, db.Model):
    def __init__(self, user_id) -> None:
        super().__init__()
        self.user_id = user_id

    __tablename__ = 'glycaemia_record'

    user_id = db.Column(db.Integer, db.ForeignKey('{}.id'.format(User.__tablename__)), nullable=False)
    state_id = db.Column(db.Integer, db.ForeignKey('{}.id'.format(State.__tablename__)), nullable=False)
    state = db.relationship(State, backref="states")

    value = db.Column(db.Integer, nullable=False)
    comment = db.Column(db.String(250), nullable=True)

    @classmethod
    def findByUserEmail(cls, email):
        return cls.query.join(User).filter(User.email == email).all()

    @classmethod
    def findByUserId(cls, user_id):
        return cls.query.filter_by(user_id=user_id).order_by(desc(Record.takenAt)).all()

    @classmethod
    def getById(cls, id):
        return cls.query.filter_by(id=id).first()

    @classmethod
    def deleteById(cls, id):
        return cls.query.filter_by(id=id).delete()
