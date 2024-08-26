from django.test import TestCase, Client
from django.contrib.auth.models import User
from .models import Feedback
# Create your tests here.
class FeedBackTestCase(TestCase):

    @classmethod
    def setUpTestData(cls):
        us=User.objects.create_superuser("superadmin",password="superadmin")
    def test_can_view_feedback_form(self):
        c = self.client
        self.assertTrue(c.login(username="superadmin",password="superadmin"))
        response=c.get("/admin/myapp/feedback/add/")
        #print(response)
        self.assertEqual(response.status_code,200)
