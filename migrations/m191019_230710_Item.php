<?php

use yii\db\Schema;
use yii\db\Migration;

class m191019_230710_Item extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable('{{%Item}}',[
            'idItem'=> $this->primaryKey(11),
            'idQueue'=> $this->integer(11)->notNull(),
            'idClient'=> $this->integer(11)->notNull(),
            'Status'=> $this->integer(11)->notNull(),
            'CreateDate'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            'StatusDate'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            'RestTime'=> $this->integer(11)->null()->defaultValue(null),
            'Position'=> $this->integer(11)->notNull(),
        ], $tableOptions);

        $this->createIndex('idQueue','{{%Item}}',['idQueue'],false);
        $this->createIndex('idClient','{{%Item}}',['idClient'],false);
        $this->addForeignKey(
            'fk_Item_idClient',
            '{{%Item}}', 'idClient',
            '{{%Owner}}', 'idOwner',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_Item_idQueue',
            '{{%Item}}', 'idQueue',
            '{{%Queue}}', 'idQueue',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
            $this->dropForeignKey('fk_Item_idClient', '{{%Item}}');
            $this->dropForeignKey('fk_Item_idQueue', '{{%Item}}');
            $this->dropTable('{{%Item}}');
    }
}
