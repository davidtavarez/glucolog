from models import db
from models.users.entries import Entry
from models.users.user import User


class Weight(Entry, db.Model):
    def __init__(self, user_id) -> None:
        super().__init__()
        self.user = user_id

    user = db.Column(db.Integer, db.ForeignKey('user.id'), nullable=False)
    value = db.Column(db.Integer, nullable=False)

    @classmethod
    def findByUserEmail(cls, email):
        return cls.query.join(User).filter(User.email == email).all()

    @classmethod
    def findByUserId(cls, user_id, order_by='takenAt', direction='desc'):
        return cls.query.filter_by(user=user_id).order_by(f"{order_by} {direction}").all()

    @classmethod
    def getById(cls, id):
        return cls.query.filter_by(id=id).first()

    @classmethod
    def deleteById(cls, id):
        return cls.query.filter_by(id=id).delete()
