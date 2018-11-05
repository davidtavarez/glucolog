from passlib.hash import pbkdf2_sha256 as sha256
from sqlalchemy.ext.hybrid import hybrid_property, hybrid_method

from models import db, Resource


class User(Resource, db.Model):
    def __init__(self, email, password) -> None:
        super().__init__()
        self.email = email
        self.password = password

    __tablename__ = 'users'
    name = db.Column(db.String(100), nullable=False, unique=False)
    email = db.Column(db.String(100), nullable=False, unique=True)
    _password = db.Column(db.String(60), nullable=False)
    birthday = db.Column(db.Date(), nullable=False)
    detection = db.Column(db.Date(), nullable=False)
    sex = db.Enum('male', 'female', nullable=False)
    diabetes = db.Enum('one', 'two', nullable=False)
    avatar = db.Column(db.String(250), nullable=True)

    @hybrid_property
    def password(self):
        return self._password

    @password.setter
    def password(self, password):
        self._password = sha256.hash(password)

    @classmethod
    def login(cls, email, password):
        user = cls.query.filter_by(email=email).first()
        if cls.verifyHash(password, user.password):
            return user
        return None

    @hybrid_method
    def verifyHash(cls, password, hash):
        return sha256.verify(password, hash)

    def __repr__(self):
        return f"{self.email}"
