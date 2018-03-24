<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "admin".
 *
 * @property int $id
 * @property string $username 管理员名
 * @property string $auth_key 自动登录令牌
 * @property string $password_hash 密码
 * @property string $password_reset_token 重置密码
 * @property int $status
 * @property int $created_at 创建时间
 * @property int $updated_at 修改时间
 * @property int $login_time 最后登录时间
 * @property int $login_ip 最后登录ip
 */
class Admin extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**自动添加时间
     * @return array
     */
    public function behaviors()
    {
        return [
            [

                'class' => TimestampBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    self::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**场景
     * @return array
     */
    public function scenarios()
    {

            $scenario = parent::scenarios();
            $scenario['add'] = ['username','status','password_hash'];
            $scenario['edit'] = ['username','status','password_hash'];
            return $scenario;


    }
    /**
     * 规则
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username','status'], 'required',],
            [['username'],'unique'],
            [['password_hash'],'safe','on'=> 'edit'],
            [['password_hash'],'required','on'=>'add']
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '管理员名',
            'auth_key' => '自动登录令牌',
            'password_hash' => '密码',
            'password_reset_token' => '重置密码',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
            'login_time' => '最后登录时间',
            'login_ip' => '最后登录ip',

        ];
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        //id得到用户对象
        return self::findOne(['id'=>$id,'status'=>1]);
        // TODO: Implement findIdentity() method.
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        //返回用户id
        return $this->id;
        // TODO: Implement getId() method.
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        //令牌返回
        return $this->auth_key;
        // TODO: Implement getAuthKey() method.
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        //令牌验证
        return $this->auth_key===$authKey;
        // TODO: Implement validateAuthKey() method.
    }
}
