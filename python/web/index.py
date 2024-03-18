import cgi
from urllib.parse import parse_qs
from wsgiref import simple_server
from orator import DatabaseManager
from orator import Model



class Feedback(Model):
    __table__ = 'feedback'
    __timestamps__ = False

def app(environ, start_response):
    path = environ["PATH_INFO"]
    method = environ["REQUEST_METHOD"]
    query = environ["QUERY_STRING"]
    data=""
    status="200 OK"
    redirect_url= ''
    if path == "/app":
        data = "Hello, Web!\n"
    if path == "/app/feedback/view":
        params = parse_qs(query)
        feedback =Feedback.find(params['id'][0])
        if feedback:
            with open("./view/feedback/view.html", "r") as f:
                data = f.read()
            data =data.replace("<?=$feedback['name']?>",feedback.nome)
            data =data.replace("<?=$feedback['email']?>",feedback.email)
            data =data.replace("<?=$feedback['feedback']?>",feedback.feedback)
        else:
            data = "Feedback not found"
            status = '404 Not Found'  # Status HTTP 404 para recurso não encontrado
    if path == "/app/feedback/create":
        with open("./view/feedback/create.html", "r") as f:
            data = f.read()
        if method == "POST":
            form = cgi.FieldStorage(fp=environ["wsgi.input"], environ=environ)
            feedback = Feedback()
            feedback.nome=form.getvalue("name")
            feedback.email=form.getvalue("email")
            feedback.feedback=form.getvalue("feedback")
            if "@" in feedback.email:
                feedback.save()
                status = "302 Found"
                redirect_url= '/app/feedback/view?id=' + str(feedback.id)

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

    start_response(status, [
        ("Content-Type", "text/html"),
        ("location",redirect_url ),
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