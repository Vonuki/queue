<?php

use yii\db\Schema;
use yii\db\Migration;

class m190922_224909_Owner extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%Owner}}',
            [
                'idOwner'=> $this->primaryKey(11),
                'Description'=> $this->string(50)->notNull(),
                'idPerson'=> $this->integer(11)->notNull(),
                'Status'=> $this->integer(11)->notNull()->defaultValue(0),
            ],$tableOptions
        );
        $this->createIndex('idPerson','{{%Owner}}',['idPerson'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('idPerson', '{{%Owner}}');
        $this->dropTable('{{%Owner}}');
    }
}
