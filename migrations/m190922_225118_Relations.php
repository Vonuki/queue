<?php

use yii\db\Schema;
use yii\db\Migration;

class m190922_225118_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_Item_idClient',
            '{{%Item}}','idClient',
            '{{%Owner}}','idOwner',
            'CASCADE','CASCADE'
         );
        $this->addForeignKey('fk_Item_idQueue',
            '{{%Item}}','idQueue',
            '{{%Queue}}','idQueue',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_Item_idClient', '{{%Item}}');
        $this->dropForeignKey('fk_Item_idQueue', '{{%Item}}');
    }
}
