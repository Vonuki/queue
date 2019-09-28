<?php

use yii\db\Schema;
use yii\db\Migration;

class m190928_223943_vItem extends Migration
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
            '{{%vItem}}',
            [
                'idItem'=> $this->integer(11)->notNull()->defaultValue(0),
                'idQueue'=> $this->integer(11)->notNull(),
                'idClient'=> $this->integer(11)->notNull(),
                'Status'=> $this->integer(11)->notNull(),
                'CreateDate'=> $this->timestamp()->notNull()->defaultValue('0000-00-00 00:00:00'),
                'StatusDate'=> $this->timestamp()->notNull()->defaultValue('0000-00-00 00:00:00'),
                'RestTime'=> $this->integer(11)->notNull()->comment('rest sec'),
                'Position'=> $this->integer(11)->notNull(),
                'QueueDescription'=> $this->string(50)->null()->defaultValue(null),
                'OwnerDescription'=> $this->string(50)->null()->defaultValue(null),
            ],$tableOptions
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%vItem}}');
    }
}
