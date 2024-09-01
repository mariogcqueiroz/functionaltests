from django.contrib import admin
from .models import DemoModel, Feedback

from .forms import FeedbackForm
class FeedbackAdmin(admin.ModelAdmin):
    form = FeedbackForm
    def save_model(self, request, obj, form, change):
        obj.user=request.user
        obj.save()


admin.site.register(Feedback,FeedbackAdmin)
admin.site.register(DemoModel)
