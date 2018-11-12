from flask_restful import Resource, reqparse


class Authentication(Resource):
    def __init__(self) -> None:
        super().__init__()
        self.parser = reqparse.RequestParser()
