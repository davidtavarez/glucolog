from flask_migrate import Migrate, MigrateCommand
from flask_script import Manager

from models import db
from run import create_app

version = 1
app = create_app("dev.json", version)

migrate = Migrate(app, db)
manager = Manager(app)
manager.add_command('db', MigrateCommand)

@manager.command
def seed():
    from models.utils.state import State
    fasting = State('fasting')
    post_meal = State('post-meal')
    db.session.add(fasting)
    db.session.add(post_meal)
    db.session.commit()

if __name__ == '__main__':
    manager.run()
