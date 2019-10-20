<?php

use yii\db\Schema;
use yii\db\Migration;

class m191019_231551_vItem extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
      DB::statement("
        CREATE VIEW vItem AS
        (
          SELECT 
            `Item`.*, 
            `Queue`.`Description` AS 'QueueDescription', 
            `Owner`.`Description` AS 'OwnerDescription'
          FROM `Item`
            LEFT JOIN `Owner` ON `Item`.`idClient` = `Owner`.`idOwner` 
            LEFT JOIN `Queue` ON `Item`.`idQueue` = `Queue`.`idQueue`
        )
      ");
    }

    public function safeDown()
    {
        $this->dropTable('{{%vItem}}');
    }
}
