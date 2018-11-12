import unittest

from tests.test_auth import AuthTestCase
from tests.users.profile import UserProfileTestCase
from tests.users.weight.weight import UserWeightTestCase
from tests.users.weight.photo import UserWeightRecordPhotoTestCase
from tests.users.glycaemia.record import UserGlycaemiaRecordTestCase
from tests.users.keys.read import UserReaOnlyKeyTestCase

from tests.utils import StatesTestCase
from tests.users.glycaemia.photo import UserGlycaemiaRecordPhotoTestCase


def suite():
    suite = unittest.TestSuite()

    suite.addTest(StatesTestCase('test_api_states_route_is_responding'))
    suite.addTest(StatesTestCase('test_api_is_returning_all_states'))

    suite.addTest(AuthTestCase('test_api_allow_registration'))
    suite.addTest(AuthTestCase('test_api_allow_login'))

    suite.addTest(UserProfileTestCase('test_api_jwt_required_to_see_my_profile'))
    suite.addTest(UserProfileTestCase('test_api_see_my_profile'))
    suite.addTest(UserProfileTestCase('test_api_edit_my_profile'))

    suite.addTest(UserProfileTestCase('test_api_get_my_avatar'))
    suite.addTest(UserProfileTestCase('test_api_edit_my_avatar'))

    suite.addTest(UserWeightTestCase('test_api_jwt_required_to_user'))
    suite.addTest(UserWeightTestCase('test_api_get_my_weight_table'))
    suite.addTest(UserWeightTestCase('test_api_get_weight_details'))
    suite.addTest(UserWeightTestCase('test_api_edit_a_weight_record'))
    suite.addTest(UserWeightTestCase('test_api_delete_a_weight_record'))

    suite.addTest(UserGlycaemiaRecordTestCase('test_api_jwt_required_to_user'))
    suite.addTest(UserGlycaemiaRecordTestCase('test_api_get_my_glycaemia_table'))
    suite.addTest(UserGlycaemiaRecordTestCase('test_api_get_glycaemia_details'))
    suite.addTest(UserGlycaemiaRecordTestCase('test_api_delete_a_glycaemia_record'))

    suite.addTest(UserGlycaemiaRecordPhotoTestCase('test_api_get_record_photo'))
    suite.addTest(UserGlycaemiaRecordPhotoTestCase('test_api_delete_record_photo'))
    suite.addTest(UserGlycaemiaRecordPhotoTestCase('test_api_save_photo'))

    suite.addTest(UserWeightRecordPhotoTestCase('test_api_get_record_photo'))
    suite.addTest(UserWeightRecordPhotoTestCase('test_api_delete_record_photo'))
    suite.addTest(UserWeightRecordPhotoTestCase('test_api_save_photo'))

    suite.addTest(UserReaOnlyKeyTestCase('test_api_get_all_users_key'))
    suite.addTest(UserReaOnlyKeyTestCase('test_api_user_can_generate_key'))
    suite.addTest(UserReaOnlyKeyTestCase('test_api_delete_user_key'))

    suite.addTest(UserReaOnlyKeyTestCase('test_api_anyone_can_read_with_keys'))

    return suite


if __name__ == '__main__':
    runner = unittest.TextTestRunner(failfast=False)
    runner.run(suite())
