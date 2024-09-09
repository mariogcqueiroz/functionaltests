<?php

use yii\db\Schema;
use yii\db\Migration;

class m140608_173539_create_user_table extends Migration
{
	public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        // Check if the user table exists
        $tablename = \Yii::$app->getModule('user-management')->user_table;

        if ($this->db->getTableSchema($tablename, true) === null) {
            // Create user table if it doesn't exist
            $this->createTable($tablename, [
                'id'                 => 'pk',
                'username'           => 'string null',
                'auth_key'           => 'varchar(32) not null',
                'password_hash'      => 'string not null',
                'confirmation_token' => 'string',
                'status'             => 'int not null default 1',
                'superadmin'         => 'smallint default 0',
                'created_at'         => 'int not null',
                'updated_at'         => 'int not null',
            ], $tableOptions);
        } else {
            echo "Table {$tablename} already exists. Skipping creation.\n";
        }
    }

	public function safeDown()
	{
		$this->dropTable(Yii::$app->getModule('user-management')->user_table);
	}
}
