import json

from routes import Routes
from tests.users import UserTestCase


class UserReaOnlyKeyTestCase(UserTestCase):

    def setUp(self):
        super().setUp()

    def test_api_get_all_users_key(self):
        url = '{0}{1}'.format(self.url, Routes.user_keys_readonly_list)
        res = self.client().get(url,
                                headers=dict(Authorization=f"Bearer {self.jwt}"),
                                content_type='application/json'
                                )
        self.assertEqual(res.status_code, 200)

    def test_api_user_can_generate_key(self):
        data = {'username': 'doctor01'}
        url = '{0}{1}'.format(self.url, Routes.user_keys_readonly_list)
        res = self.client().post(url,
                                 data=json.dumps(data),
                                 headers=dict(Authorization=f"Bearer {self.jwt}"),
                                 content_type='application/json'
                                 )

        self.assertEqual(res.status_code, 200)
        self.assertIsNotNone(res.json.get('value', None))
        self.assertIsNotNone(res.json.get('username', None))
        self.assertEqual(res.json.get('username'), data.get('username'))

    def test_api_delete_user_key(self):
        url = '{0}{1}'.format(self.url,
                              Routes.user_keys_readonly_details.replace('<int:id>', str(self.key_record_id)))
        res = self.client().delete(url,
                                   headers=dict(Authorization=f"Bearer {self.jwt}"),
                                   content_type='application/json'
                                   )
        self.assertEqual(res.status_code, 204)

    def test_api_anyone_can_read_with_keys(self):
        data = {'username': self.key_record_username, 'key': self.key_record_password}

        url = '{0}{1}'.format(self.url, Routes.user_charts_weight)
        res = self.client().post(url,
                                 data=json.dumps(data),
                                 content_type='application/json'
                                 )
        self.assertEqual(res.status_code, 200)

        url = '{0}{1}'.format(self.url, Routes.user_charts_glycaemia)
        res = self.client().post(url,
                                 data=json.dumps(data),
                                 content_type='application/json'
                                 )
        self.assertEqual(res.status_code, 200)
