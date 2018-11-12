from routes import Routes
from tests import BaseTestCase
import json


class StatesTestCase(BaseTestCase):

    def setUp(self):
        super().setUp()

    def test_api_states_route_is_responding(self):
        res = self.client().get(f'{self.url}{Routes.utils_states}')
        self.assertEqual(res.status_code, 200)

    def test_api_is_returning_all_states(self):
        res = self.client().get(f'{self.url}{Routes.utils_states}')
        self.assertEqual(res.status_code, 200)
        results = json.loads(res.data.decode('utf-8').replace("'", "\""))
        for state in results:
            self.assertIn(state['description'], ['fasting', 'post-meal'])
