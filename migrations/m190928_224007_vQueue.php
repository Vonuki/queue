<?php

use yii\db\Schema;
use yii\db\Migration;

class m190928_224007_vQueue extends Migration
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
            '{{%vQueue}}',
            [
                'idQueue'=> $this->integer(11)->notNull()->defaultValue(0),
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
                'OwnerDescription'=> $this->string(50)->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%vQueue}}');
    }
}
