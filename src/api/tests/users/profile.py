import json

from routes import Routes
from tests import BaseTestCase


class UserProfileTestCase(BaseTestCase):

    def setUp(self):
        super().setUp()


    def test_api_jwt_required_to_see_my_profile(self):
        res = self.client().get(f'{self.url}{Routes.user_profile}')
        self.assertEqual(res.status_code, 401)

    def test_api_see_my_profile(self):
        login_data = {'email': self.testing_user.get('email'), 'password': self.testing_user.get('password')}
        res_login = self.client().post(f'{self.url}{Routes.auth_login}', data=json.dumps(login_data),
                                       content_type='application/json')
        self.assertEqual(res_login.status_code, 200)

        res = self.client().get(f'{self.url}{Routes.user_profile}',
                                headers=dict(Authorization=f"Bearer {res_login.json.get('jwt', None)}"))
        self.assertEqual(res.status_code, 200)
        self.assertEqual(res.json.get('name',  None), self.testing_user.get('name'))
        self.assertEqual(res.json.get('email', None), self.testing_user.get('email'))
        self.assertEqual(res.json.get('birthday', None), self.testing_user.get('birthday'))
        self.assertEqual(res.json.get('detection', None), self.testing_user.get('detection'))
        self.assertEqual(res.json.get('sex', None), self.testing_user.get('sex'))
        self.assertEqual(res.json.get('diabetes', None), self.testing_user.get('diabetes'))
