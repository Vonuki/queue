<?php

use yii\db\Schema;
use yii\db\Migration;

class m191019_231309_Owner extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable('{{%Owner}}',[
            'idOwner'=> $this->primaryKey(11),
            'Description'=> $this->string(50)->notNull(),
            'idPerson'=> $this->integer(11)->notNull(),
            'Status'=> $this->integer(11)->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('idPerson','{{%Owner}}',['idPerson'],false);
        $this->addForeignKey(
            'fk_Owner_idPerson',
            '{{%Owner}}', 'idPerson',
            '{{%user}}', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
            $this->dropForeignKey('fk_Owner_idPerson', '{{%Owner}}');
            $this->dropTable('{{%Owner}}');
    }
}
