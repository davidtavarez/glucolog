from models import db
from models.users.entries import Entry
from models.users.user import User
import enum


class MealType(enum.Enum):
    breakfast = 'breakfast'
    lunch = 'lunch'
    dinner = 'dinner'
    snack = 'snack'
    none = 'none'

class Record(Entry, db.Model):
    def __init__(self, user_id) -> None:
        super().__init__()
        self.user_id = user_id

    __tablename__ = 'meal'

    user_id = db.Column(db.Integer, db.ForeignKey('{}.id'.format(User.__tablename__)), nullable=False)
    meal_type = db.Column(db.String(), db.Enum(MealType), nullable=True)

    @classmethod
    def getById(cls, id):
        return cls.query.filter_by(id=id).first()

    @classmethod
    def deleteById(cls, id):
        return cls.query.filter_by(id=id).delete()
