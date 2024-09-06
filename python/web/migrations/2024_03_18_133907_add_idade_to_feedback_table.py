from orator.migrations import Migration

class AddIdadeToFeedbackTable(Migration):

    def up(self):
        """
        Run the migrations.
        """
        with self.schema.table('feedback') as table:
            table.small_integer('idade').default(0)

    def down(self):
        """
        Revert the migrations.
        """
        with self.schema.table('feedback') as table:
            table.drop_column('idade')
