import unittest

from tests.test_auth import AuthTestCase
from tests.users.profile import UserProfileTestCase
from tests.utils import StatesTestCase


def suite():
    suite = unittest.TestSuite()

    suite.addTest(StatesTestCase('test_api_states_route_is_responding'))
    suite.addTest(StatesTestCase('test_api_is_returning_all_states'))

    suite.addTest(AuthTestCase('test_api_allow_registration'))
    suite.addTest(AuthTestCase('test_api_allow_login'))

    suite.addTest(UserProfileTestCase('test_api_jwt_required_to_see_my_profile'))
    suite.addTest(UserProfileTestCase('test_api_see_my_profile'))
    return suite


if __name__ == '__main__':
    runner = unittest.TextTestRunner(failfast=False)
    runner.run(suite())
