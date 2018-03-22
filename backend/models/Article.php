<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title 文章标题
 * @property string $intro 简介
 * @property int $cate_id 文章分类Id
 * @property int $status 文章状态
 * @property int $sort 文章排序
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class Article extends \yii\db\ActiveRecord
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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }




    /**设置规则
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','cate_id','status','sort'], 'required'],
            [['intro'],'safe'],
            [['created_at','updated_at'],'integer']
        ];
    }

    /**设置label
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '文章标题',
            'intro' => '简介',
            'cate_id' => '文章分类',
            'status' => '文章状态',
            'sort' => '文章排序',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    public function getCate()
    {
        return $this->hasOne(ArticleCategory::className(),['id'=>'cate_id']);
    }
    public function getContent()
    {
        return $this->hasOne(ArticleDetails::className(),['article_id'=>'id']);
    }
}
