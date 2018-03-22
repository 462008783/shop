<?php

use yii\db\Migration;

/**
 * Handles the creation of table `brand`.
 */
class m180315_075804_create_brand_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('brand', [
            'id' => $this->primaryKey(),
            'name'=> $this->string()->notNull()->comment('名称'),
            'sort'=> $this->integer()->defaultValue(100)->notNull()->comment('排序'),
            'status'=> $this->integer()->defaultValue(1)->notNull()->comment('状态'),
            'intro'=> $this->text()->comment('简介'),
            'logo'=> $this->string()->comment('图片'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('brand');
    }
}
