<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m180322_025913_create_admin_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique()->comment('管理员名'),
            'auth_key' => $this->string(32)->notNull()->comment('自动登录令牌'),
            'password_hash' => $this->string()->notNull()->comment("密码"),
            'password_reset_token' => $this->string()->unique()->comment("重置密码"),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer()->notNull()->comment('修改时间'),
            'login_time' => $this->integer()->notNull()->comment('最后登录时间'),
            'login_ip' => $this->integer()->notNull()->comment('最后登录ip'),
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
