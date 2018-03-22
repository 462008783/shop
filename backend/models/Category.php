<?php

namespace backend\models;
use backend\components\MenuQuery;
use creocoder\nestedsets\NestedSetsBehavior;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name 名称
 * @property string $intro 简介
 * @property int $depth 深度
 * @property string $pid 父级
 * @property int $tree 树
 * @property int $lft 左值
 * @property int $rgt 右值
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }


    /**配置nested
     * @return array
     */
    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                 'treeAttribute' => 'tree',
                 'leftAttribute' => 'lft',
                 'rightAttribute' => 'rgt',
                 'depthAttribute' => 'depth',
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }


    /**MenuQuery
     * @return MenuQuery
     */
    public static function find()
    {
        return new MenuQuery(get_called_class());
    }


    /**规则
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','pid'], 'required'],
            [['intro'],'safe']
        ];
    }


    /**label
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'intro' => '简介',
            'depth' => '深度',
            'pid' => '父级',
            'tree' => '树',
            'lft' => '左值',
            'rgt' => '右值',
        ];
    }
}
