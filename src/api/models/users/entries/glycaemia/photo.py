from sqlalchemy.ext.hybrid import hybrid_method

from models import db, Resource
from models.users.entries.glycaemia.record import Record


class Photo(Resource, db.Model):
    def __init__(self, record_id) -> None:
        super().__init__()
        self.glycaemia = record_id

    glycaemia = db.Column(db.Integer, db.ForeignKey('{}.id'.format(Record.__tablename__)), nullable=False)
    url = db.Column(db.String(250), nullable=True)

    @classmethod
    def getByRecordId(cls, record_id):
        return cls.query.filter_by(glycaemia=record_id).first()

    @classmethod
    def deleteByRecordId(cls, id):
        return cls.query.filter_by(glycaemia=id).delete()

    @hybrid_method
    def allowed_photo(cls, filename):
        return '.' in filename and filename.rsplit('.', 1)[1].lower() in ['jpg', 'png', 'jpeg']
