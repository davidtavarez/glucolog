import os

from flask import Flask
from flask_jwt_extended import JWTManager

from models.jwt import RevokedTokenModel
from blueprint import blueprint
from models import db

VERSION = os.getenv('API_VERSION', 1)
CONFIG_FILE = os.getenv('CONFIG_FILE', '../instance/development.json')


def create_app(config, version):
    app = Flask(__name__, instance_relative_config=False)
    app.config.from_json(config)

    app.register_blueprint(blueprint, url_prefix="/api/v{}".format(version))

    db.init_app(app)

    return app

if __name__ == '__main__':
    app = create_app(CONFIG_FILE, VERSION)
    jwt = JWTManager(app)


    @jwt.token_in_blacklist_loader
    def check_if_token_in_blacklist(decrypted_token):
        jti = decrypted_token['jti']
        return RevokedTokenModel.is_jti_blacklisted(jti)


    app.run(host='0.0.0.0', port=2009)
