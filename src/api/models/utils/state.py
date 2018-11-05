from models import db, Resource


class State(Resource, db.Model):
    __tablename__ = 'glycemia_states'
    description = db.Column(db.String(75), nullable=False, unique=True)
