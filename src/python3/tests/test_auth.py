from routes import Routes
from tests import BaseTestCase
import json


class AuthTestCase(BaseTestCase):
    def setUp(self):
        super().setUp()
        self.registration_data = {'name': 'Damian Tavarez',
                                  'email': 'davidftavarez@gmail.com',
                                  'password': '12345678',
                                  'birthday': '2015-09-20',
                                  'sex': 'male',
                                  'diabetes': 'one',
                                  'detection': '2018-03-02'}

    def test_api_allow_registration(self):
        res = self.client().post(f'{self.url}{Routes.auth_register}', data=json.dumps(self.registration_data),
                                 content_type='application/json')
        self.assertEqual(res.status_code, 201)
        self.assertIsNotNone(res.json.get('jwt', None))


    def test_api_allow_login(self):
        login_data = {'email': self.testing_user.get('email'), 'password': self.testing_user.get('password')}

        res = self.client().post(f'{self.url}{Routes.auth_login}', data=json.dumps(login_data),
                                 content_type='application/json')
        self.assertEqual(res.status_code, 200)
        self.assertIsNotNone(res.json.get('jwt', None))
