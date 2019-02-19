from routes import Routes
from tests.users import UserTestCase


class UserGlycaemiaRecordTestCase(UserTestCase):

    def setUp(self):
        super().setUp()

    def test_api_jwt_required_to_user(self):
        res = self.client().get(f'{self.url}{Routes.user_glycaemia_list}')
        self.assertEqual(res.status_code, 401)

    def test_api_get_my_glycaemia_table(self):
        res = self.client().get(f'{self.url}{Routes.user_glycaemia_list}',
                                headers=dict(Authorization=f"Bearer {self.jwt}"))
        self.assertEqual(res.status_code, 200)
        self.assertGreater(len(res.json), 0)
        self.assertEqual(len(res.json), len(self.glycaemia_records))

    def test_api_get_glycaemia_details(self):
        res = self.client().get(f'{self.url}{Routes.user_glycaemia_list}',
                                headers=dict(Authorization=f"Bearer {self.jwt}"))
        self.assertEqual(res.status_code, 200)
        self.assertGreater(len(res.json), 0)
        self.assertEqual(len(res.json), len(self.glycaemia_records))

        first_id = res.json[0].get('id')
        first_value = res.json[0].get('value')

        detailed_url ='{0}{1}'.format(self.url, Routes.user_glycaemia_details.replace('<int:id>', first_id))

        res = self.client().get(detailed_url, headers=dict(Authorization=f"Bearer {self.jwt}"))
        self.assertEqual(res.status_code, 200)
        self.assertEqual(first_value, self.glycaemia_records[0].get('value'))
        self.assertEqual(res.json.get('value'), self.glycaemia_records[0].get('value'))

    def test_api_delete_a_glycaemia_record(self):
        res = self.client().get(f'{self.url}{Routes.user_glycaemia_list}',
                                content_type='application/json',
                                headers=dict(Authorization=f"Bearer {self.jwt}"))
        self.assertEqual(res.status_code, 200)
        self.assertGreater(len(res.json), 0)
        self.assertEqual(len(res.json), len(self.glycaemia_records))

        first_id = res.json[0].get('id')

        detailed_url = '{0}{1}'.format(self.url, Routes.user_glycaemia_details.replace('<int:id>', first_id))

        res = self.client().delete(detailed_url, headers=dict(Authorization=f"Bearer {self.jwt}"))
        self.assertEqual(res.status_code, 204)