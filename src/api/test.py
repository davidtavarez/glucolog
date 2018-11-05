import unittest

from tests.test_auth import AuthTestCase
from tests.utils import StatesTestCase


def suite():
    suite = unittest.TestSuite()

    suite.addTest(StatesTestCase('test_api_states_route_is_responding'))
    suite.addTest(StatesTestCase('test_api_is_returning_all_states'))


    suite.addTest(AuthTestCase('test_api_allow_registration'))
    suite.addTest(AuthTestCase('test_api_allow_login'))

    return suite


if __name__ == '__main__':
    runner = unittest.TextTestRunner(failfast=False)
    runner.run(suite())
