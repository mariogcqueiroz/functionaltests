from django.contrib import admin
from .models import DemoModel, Feedback

from .forms import FeedbackForm
class FeedbackAdmin(admin.ModelAdmin):
    form = FeedbackForm

    def get_form(self, request, obj=None, **kwargs):
        form = super().get_form(request, obj, **kwargs)
        if obj is None:  # Apenas na criação de um novo feedback
            form.base_fields['user'].initial = request.user.id
        form._request=request
        return form

admin.site.register(Feedback,FeedbackAdmin)
admin.site.register(DemoModel)
