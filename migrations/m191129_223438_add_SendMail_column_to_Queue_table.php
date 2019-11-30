<?php
use yii\db\Migration;

/**
 * Handles adding columns to table `{{%Queue}}`.
 */
class m191129_223438_add_SendMail_column_to_Queue_table extends Migration
{
	public function init()
    {
        $this->db = 'db';
        parent::init();
    }
    /**
     * {@inheritdoc}
     */
	 
    public function safeUp()
    {
        $this->execute("DROP VIEW vQueue");
		$this->addColumn('{{%Queue}}', 'SendMail', $this->integer(1));
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
		$this->execute("DROP VIEW vQueue");
		$this->dropColumn('{{%Queue}}', 'SendMail');
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
