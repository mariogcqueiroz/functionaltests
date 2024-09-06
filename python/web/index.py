import logging
import importlib
from wsgiref import simple_server
from urllib.parse import parse_qs, urlparse
from orator import DatabaseManager
from orator import Model

def app(environ, start_response):
    path = environ['PATH_INFO']
    param = parse_qs(environ['QUERY_STRING'])

    path_array = path.split('/')
    classname = path_array[2].capitalize() + 'Controller'

    module = importlib.import_module("controllers."+ classname)
    instance= getattr(module, classname)(environ)
    response = getattr(instance, path_array[3] or 'index')(*param.values())

    start_response(response['status'], [
        ("Content-Type", "text/html"),
        ("location", response['redirect_url']),
        ("Content-Length", str(len(response['data'])))
    ])
    return [response['data'].encode()]

if __name__ == '__main__':
    config = {
        'pgsql': {
            'driver': 'pgsql',
            'host': 'db',
            'database': 'site',
            'user': 'app',
            'password': 'app2024',
            'prefix': ''
        }
    }
    logging.basicConfig(level=logging.DEBUG)
    db = DatabaseManager(config)
    Model.set_connection_resolver(db)
    w_s = simple_server.make_server(
        host="",
        port=8000,
        app=app
    )
    w_s.serve_forever()