from models import db, Resource
from models.users.user import User


class Entry(Resource):
    user = db.Column(db.ForeignKey(User), nullable=False)
    takenAt = db.Column(db.DateTime(), nullable=False)
