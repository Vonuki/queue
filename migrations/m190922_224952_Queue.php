<?php

use yii\db\Schema;
use yii\db\Migration;

class m190922_224952_Queue extends Migration
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
            '{{%Queue}}',
            [
                'idQueue'=> $this->primaryKey(11),
                'Description'=> $this->string(50)->notNull(),
                'QueueShare'=> $this->integer(11)->notNull(),
                'idOwner'=> $this->integer(11)->notNull(),
                'FirstItem'=> $this->integer(11)->null()->defaultValue(null),
                'QueueLen'=> $this->integer(11)->notNull(),
                'Status'=> $this->integer(11)->notNull()->defaultValue(0),
                'Takt'=> $this->integer(11)->null()->defaultValue(null),
                'AutoTake'=> $this->integer(11)->null()->defaultValue(null),
                'Cycle'=> $this->integer(11)->null()->defaultValue(null)->comment('Average sec In Queue'),
                'Finished'=> $this->integer(11)->null()->defaultValue(null)->comment('Total finished Items'),
            ],$tableOptions
        );
        $this->createIndex('idOwner','{{%Queue}}',['idOwner'],false);
        $this->createIndex('idLastItem','{{%Queue}}',['FirstItem'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('idOwner', '{{%Queue}}');
        $this->dropIndex('idLastItem', '{{%Queue}}');
        $this->dropTable('{{%Queue}}');
    }
}
