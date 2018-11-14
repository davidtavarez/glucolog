import json

from routes import Routes
from tests.users import UserTestCase


class UserWeightTestCase(UserTestCase):

    def setUp(self):
        super().setUp()

    def test_api_jwt_required_to_user(self):
        res = self.client().get(f'{self.url}{Routes.user_weight_list}')
        self.assertEqual(res.status_code, 401)

    def test_api_get_my_weight_table(self):
        res = self.client().get(f'{self.url}{Routes.user_weight_list}',
                                headers=dict(Authorization=f"Bearer {self.jwt}"))
        self.assertEqual(res.status_code, 200)
        self.assertGreater(len(res.json), 0)
        self.assertEqual(len(res.json), len(self.weight_records))

    def test_api_get_weight_details(self):
        res = self.client().get(f'{self.url}{Routes.user_weight_list}',
                                headers=dict(Authorization=f"Bearer {self.jwt}"))
        self.assertEqual(res.status_code, 200)
        self.assertGreater(len(res.json), 0)
        self.assertEqual(len(res.json), len(self.weight_records))

        first_id = res.json[0].get('id')

        detailed_url ='{0}{1}'.format(self.url, Routes.user_weight_details.replace('<int:id>', first_id))

        res = self.client().get(detailed_url, headers=dict(Authorization=f"Bearer {self.jwt}"))
        self.assertEqual(res.status_code, 200)

    def test_api_edit_a_weight_record(self):
        res = self.client().get(f'{self.url}{Routes.user_weight_list}',
                                headers=dict(Authorization=f"Bearer {self.jwt}"))
        self.assertEqual(res.status_code, 200)
        self.assertGreater(len(res.json), 0)
        self.assertEqual(len(res.json), len(self.weight_records))

        first_id = res.json[0].get('id')

        detailed_url = '{0}{1}'.format(self.url, Routes.user_weight_details.replace('<int:id>', first_id))

        res = self.client().get(detailed_url,
                                headers=dict(Authorization=f"Bearer {self.jwt}"),
                                content_type='application/json')
        self.assertEqual(res.status_code, 200)

        new_value = 40

        update_data = {'value': new_value}

        res = self.client().post(detailed_url,
                                 data = json.dumps(update_data),
                                 content_type='application/json',
                                 headers=dict(Authorization=f"Bearer {self.jwt}"))

        self.assertEqual(res.status_code, 200)
        self.assertEqual(res.json.get('value', None), update_data.get('value'))

    def test_api_delete_a_weight_record(self):
        res = self.client().get(f'{self.url}{Routes.user_weight_list}',
                                content_type='application/json',
                                headers=dict(Authorization=f"Bearer {self.jwt}"))
        self.assertEqual(res.status_code, 200)
        self.assertGreater(len(res.json), 0)
        self.assertEqual(len(res.json), len(self.weight_records))

        first_id = res.json[0].get('id')

        detailed_url = '{0}{1}'.format(self.url, Routes.user_weight_details.replace('<int:id>', first_id))

        res = self.client().delete(detailed_url, headers=dict(Authorization=f"Bearer {self.jwt}"))
        self.assertEqual(res.status_code, 204)