from flask import Blueprint
from flask_restful import Api

from resources.auth.register import Register
from resources.auth.login import Login
from resources.users.profile import Profile
from resources.utils.state import States
from resources.users.avatar import Avatar
from resources.users.weight.record import Record as WeightRecord
from resources.users.weight.table import Table as WeightTable

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
