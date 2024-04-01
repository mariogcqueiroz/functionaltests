from orator import Model

class Feedback(Model):
    __table__ = 'feedback'
    __timestamps__ = False

    def save(self):
        if ('@' in self.email):
            return super().save()
        return False