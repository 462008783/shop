<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_category`.
 */
class m180316_134144_create_article_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('分类名称'),
            'intro' => $this->string()->comment('简介'),
            'sort' => $this->integer()->defaultValue(100)->comment('排序'),
            'is_help' => $this->integer()->notNull()->defaultValue(0)->comment('是否帮助类'),
            'status' => $this->integer()->notNull()->defaultValue(1)->comment('状态'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article_category');
    }
}
