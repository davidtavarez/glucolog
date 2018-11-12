from sqlalchemy.ext.hybrid import hybrid_method

from models import db, Resource

from flask_sqlalchemy import Model

class Entry(Resource):
    takenAt = db.Column(db.DateTime(), nullable=False)

class EntryPhoto(Resource, Model):
    def __init__(self, record_id) -> None:
        super().__init__()
        self.record = record_id

    url = db.Column(db.String(250), nullable=True)

    @classmethod
    def getByRecordId(cls, record_id):
        return cls.query.filter_by(record=record_id).first()

    @classmethod
    def deleteByRecordId(cls, id):
        return cls.query.filter_by(record=id).delete()

    @hybrid_method
    def allowed_photo(cls, filename):
        return '.' in filename and filename.rsplit('.', 1)[1].lower() in ['jpg', 'png', 'jpeg']
