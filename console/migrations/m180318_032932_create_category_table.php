<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m180318_032932_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('名称'),
            'intro' => $this->string()->comment('简介'),
            'depth' => $this->integer()->notNull()->comment('深度'),
            'pid' => $this->string()->notNull()->comment('父级'),
            'tree' => $this->integer()->notNull()->comment('树'),
            'lft' => $this->integer()->notNull()->comment('左值'),
            'rgt' => $this->integer()->notNull()->comment('右值'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('category');
    }
}
