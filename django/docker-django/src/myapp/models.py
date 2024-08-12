from django.db import models

class Feedback(models.Model):
    nome = models.TextField(blank=True, null=True)
    email = models.TextField(blank=True, null=True)
    feedback = models.TextField(blank=True, null=True)

    class Meta:
        managed = True
        db_table = 'feedback'

class DemoModel(models.Model):
    title = models.CharField(max_length=255)
    body = models.TextField()
    image = models.ImageField(upload_to="demo_images")

    def __str__(self):
        return self.title
