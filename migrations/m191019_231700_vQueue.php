<?php

use yii\db\Schema;
use yii\db\Migration;

class m191019_231700_vQueue extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
      $this->execute("
        CREATE VIEW vQueue AS
        (
          SELECT 
            `Queue`.*, 
            `Owner`.`Description` AS 'OwnerDescription'
          FROM `Queue`
            LEFT JOIN `Owner` ON `Queue`.`idOwner` = `Owner`.`idOwner` 
        )
      ");
    }
  
    public function safeDown()
    {
        $this->dropTable('{{%vQueue}}');
    }
}
