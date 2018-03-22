<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article_category".
 *
 * @property int $id
 * @property string $name 分类名称
 * @property string $intro 简介
 * @property int $sort 排序
 * @property int $is_help 是否帮助类
 * @property int $status 状态
 */
class ArticleCategory extends \yii\db\ActiveRecord
{

    public static $status=['未激活','激活'];
    public static $is_help=['否','是'];


    /**规则
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'is_help','status','sort'], 'required'],
            [['intro'],'safe'],
            [['name'],'unique'],
        ];
    }

    /**label
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '分类名称',
            'intro' => '简介',
            'sort' => '排序',
            'is_help' => '是否帮助类',
            'status' => '状态',
        ];
    }
}
