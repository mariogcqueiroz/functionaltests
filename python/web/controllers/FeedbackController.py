import logging
import sys
sys.path.append('./app')

import cgi
from html import escape
from urllib.parse import parse_qs
from controllers.Controller import Controller
from models.Feedback import Feedback

class FeedbackController(Controller):
    def create(self):
        method = self.environ["REQUEST_METHOD"]

        with open("./views/feedback/create.php", "r") as f:
            self.data = f.read()

        if method == "POST":
            form = cgi.FieldStorage(fp=self.environ["wsgi.input"], environ=self.environ)
            feedback = Feedback()
            feedback.nome = form.getvalue("name")
            feedback.email = form.getvalue("email")
            feedback.feedback = escape(form.getvalue("feedback"))

            if feedback.save():
                self.redirectPage("/app/feedback/view?id=" + str(feedback.id))

            else:
                self.data = self.data.replace("<?=$feedback['name']?>", feedback.nome)
                self.data = self.data.replace("<?=$feedback['email']?>", feedback.email)
                self.data = self.data.replace("<?=$feedback['feedback']?>", escape(feedback.feedback))
                self.data = self.data.replace("<?=$error['email']?>", "Email deve conter @")

        else:
            self.data = self.data.replace("<?=$feedback['name']?>", "")
            self.data = self.data.replace("<?=$feedback['email']?>", "")
            self.data = self.data.replace("<?=$feedback['feedback']?>", "")
            self.data = self.data.replace("<?=$error['email']?>", "")

        return self.getResponse()

    def view(self, id):
        feedback = Feedback.find(id[0])
        if feedback:
            with open("./views/feedback/view.php", "r") as f:
                self.data = f.read()
            self.data = self.data.replace("<?=$feedback['name']?>", feedback.nome)
            self.data = self.data.replace("<?=$feedback['email']?>", feedback.email)
            self.data = self.data.replace("<?=$feedback['feedback']?>", escape(feedback.feedback))
        else:

            self.notFound()
        return self.getResponse()

    def update(self, id):
        method = self.environ["REQUEST_METHOD"]
        feedback = Feedback.find(id[0])

        if feedback:
            if method == "POST":
                form = cgi.FieldStorage(fp=self.environ["wsgi.input"], environ=self.environ)
                feedback.nome = form.getvalue("name")
                feedback.email = form.getvalue("email")
                feedback.feedback = escape(form.getvalue("feedback"))

                if feedback.save():
                    self.redirectPage("/app/feedback/view?id=" + str(feedback.id))

                else:
                    with open("./views/feedback/update.php", "r") as f:
                        self.data = f.read()
                    self.data = self.data.replace("<?=$feedback['id']?>", str(feedback.id))

                    self.data = self.data.replace("<?=$feedback['name']?>", feedback.nome)
                    self.data = self.data.replace("<?=$feedback['email']?>", feedback.email)
                    self.data = self.data.replace("<?=$feedback['feedback']?>", escape(feedback.feedback))
                    self.data = self.data.replace("<?=$error['email']?>", "Email deve conter @")

            else:
                with open("./views/feedback/update.php", "r") as f:
                    self.data = f.read()
                self.data = self.data.replace("<?=$feedback['id']?>", str(feedback.id))

                self.data = self.data.replace("<?=$feedback['name']?>", feedback.nome)
                self.data = self.data.replace("<?=$feedback['email']?>", feedback.email)
                self.data = self.data.replace("<?=$feedback['feedback']?>", escape(feedback.feedback))

        else:
            self.notFound()

        return self.getResponse()

    def delete(self,id):
        feedback = Feedback.find(id[0])
        if feedback:
            feedback.delete()
            self.redirectPage("/app/feedback/index")
        else:
            self.notFound()

        return self.getResponse()

    def index(self):
        feedbackList = Feedback.all()
        with open("./views/feedback/index.php", "r") as f:
            self.data = f.read()

        rows = ""
        for feedback in feedbackList:
            newrow = \
                f"""
            <tr>
                <td>{feedback.id}</td>
                <td>{feedback.nome}</td>
                <td>{feedback.email}</td>
                <td>{escape(feedback.feedback)}</td>
                <td>
                    <!-- Botão de edição -->
                    <a href="/app/feedback/update?id={feedback.id}" class="btn btn-primary">Editar</a>
                    <!-- Botão de exclusão (com confirmação) -->
                    <a href="/app/feedback/delete?id={feedback.id}" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este item?')">Excluir</a>
                </td>
            </tr>
            """

            rows += newrow

        self.data = self.data.replace("<?=$feedback['all']?>", rows)

        return self.getResponse()