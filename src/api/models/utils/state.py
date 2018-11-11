from models import db, Resource


class State(Resource, db.Model):
    def __init__(self, description) -> None:
        super().__init__()
        self.description = description

    description = db.Column(db.String(25), nullable=False, unique=True)

    @classmethod
    def getById(cls, id):
        return cls.query.filter_by(id=id).first()

    @classmethod
    def getByDescription(cls, description):
        return cls.query.filter_by(description=description).first()
