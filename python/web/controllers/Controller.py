class Controller:
    def __init__(self,env) -> None:
        self.environ=env
        self.data = ""
        self.status = "200 OK"
        self.redirect_url = ""

    def notFound(self):
        with open("./views/public/404.html", "r") as f:
            NotFoundPage = f.read()

        self.data = NotFoundPage
        self.status = "404 Not Found"

    def redirectPage(self, url: str):
        self.redirect_url = url
        self.status = "302 Found"

    def getResponse(self):
        return {'status': self.status, 'redirect_url': self.redirect_url, 'data': self.data}
