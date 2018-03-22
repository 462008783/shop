<?php
/**
 * Created by PhpStorm.
 * User: 秦鹍
 * Date: 2018/3/21
 * Time: 15:42
 */

namespace backend\models;


use yii\base\Model;
use yii\web\IdentityInterface;

class LoginForm extends Model
{

    //
    public $username;
    public $password;
    public $rememberMe = true;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['rememberMe'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '管理员帐号',
            'password' => '管理员密码',
            'rememberMe'=>'记住密码'
        ];
    }
}