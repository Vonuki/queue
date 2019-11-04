<?php

use yii\db\Schema;
use yii\db\Migration;

class m191019_231502_Queue extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable('{{%Queue}}',[
            'idQueue'=> $this->primaryKey(11),
            'Description'=> $this->string(50)->notNull(),
            'QueueShare'=> $this->integer(11)->notNull(),
            'idOwner'=> $this->integer(11)->notNull(),
            'FirstItem'=> $this->integer(11)->notNull(),
            'QueueLen'=> $this->integer(11)->notNull(),
            'Takt'=> $this->integer(11)->notNull()->defaultValue(0),
            'Cycle'=> $this->integer(11)->null()->defaultValue(null),
            'AutoTake'=> $this->integer(11)->null()->defaultValue(null),
            'Finished'=> $this->integer(11)->null()->defaultValue(null),
            'Status'=> $this->integer(11)->null()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('idOwner','{{%Queue}}',['idOwner'],false);
        $this->addForeignKey(
            'fk_Queue_idOwner',
            '{{%Queue}}', 'idOwner',
            '{{%Owner}}', 'idOwner',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
            $this->dropForeignKey('fk_Queue_idOwner', '{{%Queue}}');
            $this->dropTable('{{%Queue}}');
    }
}
