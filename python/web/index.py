import cgi
from wsgiref import simple_server
from orator import DatabaseManager
from orator import Model


class Feedback(Model):
    __table__ = 'feedback'
    __timestamps__ = False

def app(environ, start_response):
    path = environ["PATH_INFO"]
    method = environ["REQUEST_METHOD"]
    data=""
    if path == "/app":
        data = "Hello, Web!\n"
    if path == "/app/feedback":
        with open("./view/feedback/create.html", "r") as f:
            data = f.read()
        if method == "POST":
            form = cgi.FieldStorage(fp=environ["wsgi.input"], environ=environ)
            feedback = Feedback()
            feedback.nome=form.getvalue("name")
            feedback.email=form.getvalue("email")
            feedback.feedback=form.getvalue("feedback")
            if "@" in feedback.email:
                with open("./view/feedback/view.html", "r") as f:
                    data = f.read()
                data =data.replace("<?=$feedback['name']?>",feedback.nome)
                data =data.replace("<?=$feedback['email']?>",feedback.email)
                data =data.replace("<?=$feedback['feedback']?>",feedback.feedback)
                feedback.save()
            else:
                data =data.replace("<?=$feedback['name']?>",feedback.nome)
                data =data.replace("<?=$feedback['email']?>",feedback.email)
                data =data.replace("<?=$feedback['feedback']?>",feedback.feedback)
                data =data.replace("<?=$error['email']?>",'Email deve conter @')
        else:
            data =data.replace("<?=$feedback['name']?>","")
            data =data.replace("<?=$feedback['email']?>","")
            data =data.replace("<?=$feedback['feedback']?>","")
            data =data.replace("<?=$error['email']?>",'')

    start_response("200 OK", [
        ("Content-Type", "text/html"),
        ("Content-Length", str(len(data)))
    ])
    return [data.encode()]

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

    db = DatabaseManager(config)
    Model.set_connection_resolver(db)
    w_s = simple_server.make_server(
        host="",
        port=8000,
        app=app
    )
    w_s.serve_forever()