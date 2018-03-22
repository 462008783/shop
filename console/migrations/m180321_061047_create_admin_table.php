<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m180321_061047_create_admin_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('用户帐号'),
            'password' => $this->string()->notNull()->comment('用户密码'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('admin');
    }
}
