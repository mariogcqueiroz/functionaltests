from django.contrib import admin
from .models import DemoModel, Feedback

from .forms import FeedbackForm
class FeedbackAdmin(admin.ModelAdmin):
    form = FeedbackForm
admin.site.register(Feedback,FeedbackAdmin)
admin.site.register(DemoModel)
