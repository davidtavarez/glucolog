from flask import Blueprint
from flask_restful import Api

from resources.auth.register import Register
from resources.auth.login import Login
from resources.utils.state import States
from routes import Routes

blueprint = Blueprint(name='api', import_name=__name__)

api = Api(blueprint)

api.add_resource(Register, Routes.auth_register)
api.add_resource(Login, Routes.auth_login)

api.add_resource(States, Routes.utils_states)
