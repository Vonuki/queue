<?php

use yii\db\Schema;
use yii\db\Migration;

class m190922_224910_Relations extends Migration
{

    public function init()
    {
       $this->db = 'db';
       parent::init();
    }

    public function safeUp()
    {
        $this->addForeignKey('fk_Owner_idPerson',
            '{{%Owner}}','idPerson',
            '{{%user}}','id',
            'CASCADE','CASCADE'
         );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_Owner_idPerson', '{{%Owner}}');
    }
}
