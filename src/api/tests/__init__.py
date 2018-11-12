import random
import unittest

from flask_jwt_extended import JWTManager

from models import db
from models.jwt import RevokedTokenModel
from models.users.entries.weight.record import Record as WeightModel
from models.users.entries.weight.photo import Photo as WeightPhotoModel

from models.users.entries.glycaemia.record import Record as GlycaemiaModel
from models.users.entries.glycaemia.photo import Photo as GlycaemiaPhotoModel

from models.utils.state import State as StateModel

from models.users.keys.read import Read as KeyModel

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

        self.glycaemia_records = [{'takenAt': '2018-03-02 08:20:01', 'value': 90},
                                  {'takenAt': '2018-03-02 10:30:31', 'value': 120},
                                  {'takenAt': '2018-03-02 12:05:16', 'value': 90},
                                  {'takenAt': '2018-03-02 6:00:50', 'value': 160},
                                  {'takenAt': '2018-05-01 20:42:20', 'value': 130}]

        self.record_photo = {'url': 'https://DUMMY/URL'}
        self.glycaemia_record_photo_id = -1
        self.weight_record_photo_id = -1
        self.key_record_id = -1

        self.key_record_password = ''
        self.key_record_username = ''

        self.state_records = ['fasting', 'post-meal']

        jwt = JWTManager(self.app)

        @jwt.token_in_blacklist_loader
        def check_if_token_in_blacklist(decrypted_token):
            jti = decrypted_token['jti']
            return RevokedTokenModel.is_jti_blacklisted(jti)

        with self.app.app_context():
            db.drop_all()
            db.create_all()

            for state in self.state_records:
                record = StateModel(state)
                db.session.add(record)

            db.session.commit()

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

            for record in self.glycaemia_records:
                glycemia = GlycaemiaModel(user.id)
                glycemia.value = record.get('value')

                rand = round(random.uniform(0, 1))
                state = self.state_records[rand]
                state = StateModel.getByDescription(state).id
                glycemia.state_id = state
                glycemia.comment = "random record {}".format(state)
                glycemia.takenAt = datetime.datetime.strptime(record.get('takenAt'), "%Y-%m-%d %H:%M:%S").date()
                db.session.add(glycemia)

            db.session.commit()

            last_glycemia_record = GlycaemiaModel.findByUserId(user.id).pop().id
            glycemia_record_photo = GlycaemiaPhotoModel(last_glycemia_record)
            glycemia_record_photo.url = self.record_photo.get('url')
            db.session.add(glycemia_record_photo)

            db.session.commit()

            last_weight_record = WeightModel.findByUserId(user.id).pop().id
            weight_record_photo = WeightPhotoModel(last_weight_record)
            weight_record_photo.url = self.record_photo.get('url')
            db.session.add(weight_record_photo)

            db.session.commit()

            key = KeyModel(user.id)
            key.value = KeyModel.generateKey()
            self.key_record_password = key.value
            key.username = 'testing01'
            self.key_record_username = key.username
            db.session.add(key)

            db.session.commit()

            self.glycaemia_record_photo_id = last_glycemia_record
            self.weight_record_photo_id = last_weight_record
            self.key_record_id = KeyModel.getByUsername('testing01').id
