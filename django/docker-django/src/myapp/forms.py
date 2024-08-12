from django import forms
from .models import Feedback
class FeedbackForm(forms.ModelForm):
    nome = forms.CharField(widget=forms.TextInput)
    class Meta:
        model = Feedback
        fields = '__all__'
