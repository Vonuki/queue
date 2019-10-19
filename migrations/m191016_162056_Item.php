<?php

use yii\db\Schema;
use yii\db\Migration;

class m191016_162056_Item extends Migration
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
            '{{%Item}}',
            [
                'idItem'=> $this->primaryKey(11),
                'idQueue'=> $this->integer(11)->notNull(),
                'idClient'=> $this->integer(11)->notNull(),
                'Status'=> $this->integer(11)->notNull(),
                'CreateDate'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
                'StatusDate'=> $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
                'RestTime'=> $this->integer(11)->notNull()->comment('rest sec'),
                'Position'=> $this->integer(11)->notNull(),
                'Comment'=> $this->string(1000)->notNull()->defaultValue(''''),
            ],$tableOptions
        );
        $this->createIndex('idQueue','{{%Item}}',['idQueue'],false);
        $this->createIndex('idClient','{{%Item}}',['idClient'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('idQueue', '{{%Item}}');
        $this->dropIndex('idClient', '{{%Item}}');
        $this->dropTable('{{%Item}}');
    }
}
