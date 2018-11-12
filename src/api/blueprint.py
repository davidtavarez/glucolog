from flask import Blueprint
from flask_restful import Api

from resources.auth.register import Register
from resources.auth.login import Login
from resources.jwt import TokenRefresh, UserLogoutRefresh, UserLogoutAccess
from resources.users.profile import Profile
from resources.utils.state import States
from resources.users.avatar import Avatar
from resources.users.weight.record import WeightRecord
from resources.users.weight.table import WeightTable
from resources.users.weight.photo import WeightPhoto

from resources.users.glycaemia.record import GlycaemiaRecord
from resources.users.glycaemia.table import GlycaemiaTable
from resources.users.glycaemia.photo import GlycaemiaPhoto

from resources.users.keys.record import KeyRecord
from resources.users.keys.table import KeyTable

from resources.charts.glycaemia import GlycaemiaData
from resources.charts.weight import WeightData


from routes import Routes

blueprint = Blueprint(name='api', import_name=__name__)

api = Api(blueprint)

api.add_resource(Register, Routes.auth_register)
api.add_resource(Login, Routes.auth_login)

api.add_resource(States, Routes.utils_states)
api.add_resource(Profile, Routes.user_profile)

api.add_resource(Avatar, Routes.user_avatar)

api.add_resource(WeightTable, Routes.user_weight_list)
api.add_resource(WeightRecord, Routes.user_weight_details)
api.add_resource(WeightPhoto, Routes.user_weight_photo)


api.add_resource(GlycaemiaTable, Routes.user_glycaemia_list)
api.add_resource(GlycaemiaRecord, Routes.user_glycaemia_details)
api.add_resource(GlycaemiaPhoto, Routes.user_glycaemia_photo)

api.add_resource(KeyTable, Routes.user_keys_readonly_list)
api.add_resource(KeyRecord, Routes.user_keys_readonly_details)

api.add_resource(GlycaemiaData, Routes.user_charts_glycaemia)
api.add_resource(WeightData, Routes.user_charts_weight)

api.add_resource(UserLogoutAccess, Routes.auth_logout)
api.add_resource(UserLogoutRefresh, Routes.auth_logout_refresh)
api.add_resource(TokenRefresh, Routes.auth_token_refresh)