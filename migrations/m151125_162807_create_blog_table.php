<?php

use yii\db\Schema;
use yii\db\Migration;

class m151125_162807_create_blog_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%blog}}', [
            'id' => $this->primaryKey(),
            'category_id' =>$this->integer()->notNull(),
            'user_id' =>$this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
            'prev_img' => $this->string()->notNull(),
            'images_id' => $this->integer(),
            'publication_at' => $this->dateTime(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'order' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('idx_category_id', '{{%blog}}', 'category_id');
        $this->createIndex('idx_user_id', '{{%blog}}', 'user_id');
        $this->createIndex('status', '{{%blog}}', 'status');
        $this->createIndex('slug', '{{%blog}}', 'slug', TRUE);

        $this->addForeignKey('FK_blog_user_id', '{{%blog}}', 'user_id', '{{%user}}', 'id');

// Table Category
        $this->createTable('{{%blog_category}}', [
            'id' => $this->primaryKey(),
            'parent_id' =>$this->smallInteger()->notNull()->defaultValue(0),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'prev_img' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'order' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('parent_id', '{{%blog_category}}', 'parent_id');
        $this->createIndex('slug', '{{%blog_category}}', 'slug', TRUE);
        $this->createIndex('status', '{{%blog_category}}', 'status');

        $this->addForeignKey('FK_blog_category', '{{%blog}}', 'category_id', '{{%blog_category}}', 'id');

// Table Tags
        $this->createTable('{{%blog_tags}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'frequency' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%blog_tags_blog}}', [
            'blog_id' => $this->integer()->notNull(),
            'tags_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('index_blog_id', '{{%blog_tags_blog}}', 'blog_id');
        $this->createIndex('index_tags_id', '{{%blog_tags_blog}}', 'tags_id');

        $this->addForeignKey('FK_blog_tags', '{{%blog_tags_blog}}', 'blog_id', '{{%blog}}', 'id');
        $this->addForeignKey('FK_tags_blog_tags', '{{%blog_tags_blog}}', 'tags_id', '{{%blog_tags}}', 'id');


    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_blog_category','{{%blog}}');
        $this->dropForeignKey('FK_blog_tags','{{%blog_tags_blog}}');
        $this->dropForeignKey('FK_tags_blog_tags','{{%blog_tags_blog}}');
        $this->dropForeignKey('FK_blog_user_id', '{{%blog}}');

        $this->dropTable('{{%blog}}');
        $this->dropTable('{{%blog_category}}');
        $this->dropTable('{{%blog_tags}}');
        $this->dropTable('{{%blog_tags_blog}}');

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
