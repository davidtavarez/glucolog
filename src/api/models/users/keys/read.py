import random

from sqlalchemy import desc

from models import db, Resource
from models.users.user import User


class Read(Resource, db.Model):
    def __init__(self, user_id) -> None:
        super().__init__()
        self.user_id = user_id

    __tablename__ = 'user_keys_read'

    user_id = db.Column(db.Integer, db.ForeignKey('{}.id'.format(User.__tablename__)), nullable=False)

    username = db.Column(db.String(100), nullable=False, unique=False)
    value = db.Column(db.String(64), nullable=False, unique=True)

    @classmethod
    def findByUserEmail(cls, email):
        return cls.query.join(User).filter(User.email == email).order_by(desc(Read.createdAt)).all()

    @classmethod
    def getByUsername(cls, username):
        return cls.query.filter(Read.username == username).first()

    @classmethod
    def generateKey(cls):
        length = 8
        key = ''
        for i in range(length): key += (str(chr(random.randint(97, 122))))
        return key.upper()

    @classmethod
    def deleteById(cls, id):
        return cls.query.filter_by(id=id).delete()
