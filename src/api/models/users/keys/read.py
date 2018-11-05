from models import db, Resource
from models.users.user import User


class Read(Resource, db.Model):
    __tablename__ = 'user_readonly_keys'
    user = db.Column(db.ForeignKey(User), nullable=False)
    name = db.Column(db.String(100), nullable=False, unique=False)
    vale = db.Column(db.String(64), nullable=False, unique=True)
