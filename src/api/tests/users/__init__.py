import json

from routes import Routes
from tests import BaseTestCase


class UserTestCase(BaseTestCase):

    def setUp(self):
        super().setUp()

        login_data = {'email': self.testing_user.get('email'), 'password': self.testing_user.get('password')}
        res_login = self.client().post(f'{self.url}{Routes.auth_login}', data=json.dumps(login_data),
                                       content_type='application/json')
        self.assertEqual(res_login.status_code, 200)
        self.jwt = res_login.json.get('jwt', None)
