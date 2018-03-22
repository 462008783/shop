<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m180317_052622_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->comment('文章标题'),
            'intro' => $this->string()->comment('简介'),
            'cate_id' => $this->integer()->comment('文章分类Id'),
            'status' => $this->integer()->notNull()->defaultValue(1)->comment('文章状态'),
            'sort' => $this->integer()->notNull()->defaultValue(100)->comment('文章排序'),
            'created_at' => $this->integer()->comment('创建时间'),
            'updated_at' => $this->integer()->comment('更新时间'),
        ]);

        $this->createTable('article_details',[
            'id' => $this->primaryKey(),
            'detailes' => $this->text()->comment('文章内容'),
            'aeticle_id' => $this->integer()->comment('文章Id')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article');
        $this->dropTable('article_details');
    }
}
