from flask_sqlalchemy import SQLAlchemy

db = SQLAlchemy()


class Resource(object):
    id = db.Column(db.Integer(), primary_key=True)
    createdAt = db.Column(db.TIMESTAMP, server_default=db.func.current_timestamp(), nullable=False)
    updatedAt = db.Column(db.TIMESTAMP, server_default=db.func.current_timestamp(),
                          onupdate=db.func.current_timestamp(), nullable=False)

    def safe(self):
        db.session.add(self)
        db.session.commit()
