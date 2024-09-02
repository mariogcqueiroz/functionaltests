from django import forms
from .models import Feedback
from django.contrib.auth.models import User

class FeedbackForm(forms.ModelForm):
    nome = forms.CharField(widget=forms.TextInput)
    user = forms.CharField(widget=forms.HiddenInput)


    class Meta:
        model = Feedback
        fields = '__all__'
