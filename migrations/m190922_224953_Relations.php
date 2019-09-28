<?php

use yii\db\Schema;
use yii\db\Migration;

class m190922_224953_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_Queue_idOwner',
            '{{%Queue}}','idOwner',
            '{{%Owner}}','idOwner',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_Queue_idOwner', '{{%Queue}}');
    }
}
