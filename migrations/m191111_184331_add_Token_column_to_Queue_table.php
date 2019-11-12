<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%Queue}}`.
 */
class m191111_184331_add_Token_column_to_Queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("DROP VIEW vQueue");
        $this->addColumn('{{%Queue}}', 'Token', $this->string(10));
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

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%Queue}}', 'Token');
        $this->execute("DROP VIEW vQueue");
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
}
