from django.contrib import admin
from .models import DemoModel, Feedback


admin.site.register(Feedback)
admin.site.register(DemoModel)
