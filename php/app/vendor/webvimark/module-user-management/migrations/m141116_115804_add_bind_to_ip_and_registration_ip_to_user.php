<?php

use yii\db\Migration;

class m141116_115804_add_bind_to_ip_and_registration_ip_to_user extends Migration
{
    public function safeUp()
    {
        $userTable = Yii::$app->getModule('user-management')->user_table;

  
        if ($this->db->getTableSchema($userTable, true)->getColumn('registration_ip') === null) {
            $this->addColumn($userTable, 'registration_ip', 'varchar(255)');
            echo "Coluna 'registration_ip' adicionada com sucesso.\n";
        } else {
            echo "A coluna 'registration_ip' já existe. Pular adição.\n";
        }
        if ($this->db->getTableSchema($userTable, true)->getColumn('bind_to_ip') === null) {
            $this->addColumn($userTable, 'bind_to_ip', 'string');
            echo "Coluna 'bind_to_ip' adicionada com sucesso.\n";
        } else {
            echo "A coluna 'bind_to_ip' já existe. Pular adição.\n";
        }

      
        if (Yii::$app->cache) {
            Yii::$app->cache->flush();
        }
    }

    public function safeDown()
    {
        $userTable = Yii::$app->getModule('user-management')->user_table;

        if ($this->db->getTableSchema($userTable, true)->getColumn('bind_to_ip') !== null) {
            $this->dropColumn($userTable, 'bind_to_ip');
            echo "Coluna 'bind_to_ip' removida com sucesso.\n";
        } else {
            echo "A coluna 'bind_to_ip' não existe. Pular remoção.\n";
        }

        if ($this->db->getTableSchema($userTable, true)->getColumn('registration_ip') !== null) {
            $this->dropColumn($userTable, 'registration_ip');
            echo "Coluna 'registration_ip' removida com sucesso.\n";
        } else {
            echo "A coluna 'registration_ip' não existe. Pular remoção.\n";
        }

     
        if (Yii::$app->cache) {
            Yii::$app->cache->flush();
        }
    }
}
