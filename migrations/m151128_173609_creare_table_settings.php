<?php

use yii\db\Schema;
use yii\db\Migration;

class m151128_173609_creare_table_settings extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%settings}}',[
            'id' => $this->primaryKey(),
            'type' => $this->string(),
            'section' => $this->string()->notNull(),
            'key' => $this->string()->notNull(),
            'value' => $this->string()->notNull(),
            'description' => $this->text(),
            'active' =>$this->smallInteger(1),
            'created' =>$this->string()->notNull(),
            'modified' =>$this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('index_key', '{{%settings}}', 'key', TRUE);
    }

    public function down()
    {
        $this->dropTable('{{%settings}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
