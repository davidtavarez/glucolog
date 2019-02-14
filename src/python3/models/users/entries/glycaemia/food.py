from models import db
from models.users.entries import Entry
from models.users.entries.glycaemia.record  import Record
from models.utils.state import State
from sqlalchemy import desc
import enum

class MealType(enum.Enum):
    breakfast = "breakfast"
    lunch = "lunch"
    dinner = "dinner"
    snack = "snack"
    none = "none"

class Food(Entry, db.Model):
    def __init__(self) -> None:
        super().__init__()

    __tablename__ = 'food'

    record_id = db.Column(db.Integer, db.ForeignKey('{}.id'.format(Record.__tablename__)), nullable=False)
    food_id = db.Column(db.String(20), nullable=False)
    calories =  db.Column(db.Integer, nullable=False)
    name = db.Column(db.String(100), nullable=False)
    description = db.Column(db.String(100), nullable=True)
    meal_type = db.Column(db.String(), db.Enum(MealType), nullable=True)
    created_date = db.Column(db.DateTime(), nullable=False)
    insulin_per_20_grams = db.Column(db.Integer, nullable=True)

    @classmethod
    def getById(cls, id):
        return cls.query.filter_by(id=id).first()

    @classmethod
    def deleteById(cls, id):
        return cls.query.filter_by(id=id).delete()
