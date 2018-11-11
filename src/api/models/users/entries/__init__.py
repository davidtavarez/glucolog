from models import db, Resource


class Entry(Resource):
    takenAt = db.Column(db.DateTime(), nullable=False)

