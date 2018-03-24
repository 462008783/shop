<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "auth_item".
 *
 * @property string $name
 * @property int $type
 * @property string $description
 * @property string $rule_name
 * @property resource $data
 * @property int $created_at
 * @property int $updated_at
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthRule $ruleName
 * @property AuthItemChild[] $authItemChildren
 * @property AuthItemChild[] $authItemChildren0
 * @property AuthItem[] $children
 * @property AuthItem[] $parents
 */
class AuthItem extends \yii\db\ActiveRecord
{

    //定义属性
    public $permission;

    /**
     * 设置规则
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required',],
            [['description'],'safe'],
            [['permission'],'safe'],
            [['name'],'unique']

        ];
    }

    /**
     * 设置label
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '角色权限名称',
            'description' => '描述',
            'permission' => '权限'
        ];
    }

}
