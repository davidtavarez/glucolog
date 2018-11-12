import enum

from passlib.hash import pbkdf2_sha256 as sha256
from sqlalchemy.ext.hybrid import hybrid_property, hybrid_method

from models import db, Resource


class Sex(enum.Enum):
    male = "male"
    female = "female"


class DiabetesType(enum.Enum):
    one = "one"
    two = "two"


class User(Resource, db.Model):
    def __init__(self, email, password) -> None:
        super().__init__()
        self.email = email
        self.password = password

    name = db.Column(db.String(100), nullable=True, unique=False)
    email = db.Column(db.String(100), nullable=False, unique=True)
    _password = db.Column(db.String(60), nullable=False)
    birthday = db.Column(db.Date(), nullable=True)
    detection = db.Column(db.Date(), nullable=True)
    sex = db.Column(db.String(), db.Enum(Sex), nullable=True)
    diabetes = db.Column(db.String(), db.Enum(DiabetesType), nullable=True)
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

    @classmethod
    def find(cls, email):
        return cls.query.filter_by(email=email).first()

    @classmethod
    def find_avatar(cls, email):
        return cls.query.with_entities(User.avatar).filter_by(email=email).first()

    @hybrid_method
    def allowed_avatar(cls, filename):
        return '.' in filename and filename.rsplit('.', 1)[1].lower() in ['jpg', 'png', 'jpeg']

    @hybrid_method
    def verifyHash(cls, password, hash):
        return sha256.verify(password, hash)

    @classmethod
    def findByKeys(cls, username, key):
        from models.users.keys.read import Read as Key

        return cls.query.join(Key).filter(Key.username == username and Key.value == key).first()

    def __repr__(self):
        return f"{self.email}"
