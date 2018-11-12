from flask_sqlalchemy import Model
from flask_sqlalchemy import SQLAlchemy
from sqlalchemy import Column, Integer, TIMESTAMP, func

db = SQLAlchemy()


class Resource(Model):
    id = Column(Integer(), primary_key=True)
    createdAt = Column(TIMESTAMP, server_default=func.current_timestamp(), nullable=False)
    updatedAt = Column(TIMESTAMP, server_default=func.current_timestamp(),
                          onupdate=func.current_timestamp(), nullable=False)

    def safe(self):
        db.session.add(self)
        db.session.commit()
