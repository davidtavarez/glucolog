import unittest

from flask_jwt_extended import JWTManager

from models import db
from models.jwt import RevokedTokenModel
from models.users.entries.weight import Weight as WeightModel
from models.utils.state import State
from run import create_app, VERSION
from models.users.user import User as UserModel, Sex, DiabetesType

import datetime


class BaseTestCase(unittest.TestCase):

    def setUp(self):
        self.app = create_app("testing.json", VERSION)
        self.client = self.app.test_client
        self.url = '/api/v1'

        self.testing_user = {'name': 'Testing User',
                             'email': 'testing@glucolog',
                             'password': '12345678',
                             'birthday': '2015-09-20',
                             'sex': Sex.male.value,
                             'diabetes': DiabetesType.one.value,
                             'detection': '2018-03-02'}

        self.weight_records = [{'takenAt': '2018-03-02', 'value': 20},
                               {'takenAt': '2018-03-15', 'value': 25},
                               {'takenAt': '2018-04-02', 'value': 22},
                               {'takenAt': '2018-04-17', 'value': 23},
                               {'takenAt': '2018-05-01', 'value': 28},
                               {'takenAt': '2018-06-03', 'value': 35}]

        jwt = JWTManager(self.app)

        @jwt.token_in_blacklist_loader
        def check_if_token_in_blacklist(decrypted_token):
            jti = decrypted_token['jti']
            return RevokedTokenModel.is_jti_blacklisted(jti)

        with self.app.app_context():
            db.drop_all()
            db.create_all()

            fasting = State()
            fasting.description = 'fasting'
            db.session.add(fasting)
            post_meal = State()
            post_meal.description = 'post-meal'
            db.session.add(post_meal)

            user = UserModel(self.testing_user.get('email'), self.testing_user.get('password'))
            user.name = self.testing_user.get('name')
            user.birthday = datetime.datetime.strptime(self.testing_user.get('birthday'), "%Y-%m-%d").date()
            user.detection = datetime.datetime.strptime(self.testing_user.get('detection'), "%Y-%m-%d").date()
            user.sex = self.testing_user.get('sex')
            user.diabetes = self.testing_user.get('diabetes')
            db.session.add(user)

            db.session.commit()

            UserModel.query.filter_by(email=self.testing_user.get('email')).first()

            for record in self.weight_records:
                weight = WeightModel(user.id)
                weight.value = record.get('value')
                weight.takenAt = datetime.datetime.strptime(record.get('takenAt'), "%Y-%m-%d").date()
                db.session.add(weight)
            db.session.commit()