import cgi
from wsgiref import simple_server
import psycopg2


def app(environ, start_response):
    path = environ["PATH_INFO"]
    method = environ["REQUEST_METHOD"]
    data=""
    if path == "/app":
        data = "Hello, Web!\n"
    if path == "/app/feedback":
        with open("feedback.html", "r") as f:
            data = f.read()
        if method == "POST":
            form = cgi.FieldStorage(fp=environ["wsgi.input"], environ=environ)
            feedback = {
                "name": form.getvalue("name"),
                "email": form.getvalue("email"),
                "feedback": form.getvalue("feedback"),
            }
            if "@" in feedback["email"]:
                data = "Your feedback submitted successfully."
                conn = psycopg2.connect(
                    host="db",
                    dbname="site",
                    port=5432,
                    user="app",
                    password="app2024"
                )
                cur = conn.cursor()
                sql = f"INSERT INTO feedback(nome, email, feedback) " \
                      f"VALUES ('{feedback['name']}', '{feedback['email']}', '{feedback['feedback']}')"
                cur.execute(sql)
                conn.commit()
                cur.close()
                conn.close()
            else:
                data =data.replace("<?=$feedback['name']?>",feedback['name'])
                data =data.replace("<?=$feedback['email']?>",feedback['email'])
                data =data.replace("<?=$feedback['feedback']?>",feedback['feedback'])
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
    w_s = simple_server.make_server(
        host="",
        port=8000,
        app=app
    )
    w_s.serve_forever()