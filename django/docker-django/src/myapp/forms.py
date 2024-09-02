from django import forms
from .models import Feedback
from django.contrib.auth.models import User
from django.core.exceptions import PermissionDenied

class FeedbackForm(forms.ModelForm):
    nome = forms.CharField(widget=forms.TextInput)
    user = forms.CharField(widget=forms.HiddenInput)

    def clean_user(self):
        user_id=self.cleaned_data.get('user')
        cur_user=self._request.user
        if (  not cur_user.is_superuser and int(user_id) != cur_user.id and
                self._request.user.has_perm("myapp.change_only_yours")):
            raise PermissionDenied()
        user = User.objects.get(id=user_id)
        return user
    class Meta:
        model = Feedback
        fields = '__all__'
