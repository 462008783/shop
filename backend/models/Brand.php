<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property int $id
 * @property string $name 名称
 * @property int $sort 排序
 * @property int $status 状态
 * @property string $intro 简介
 * @property string $logo 图片
 */
class Brand extends \yii\db\ActiveRecord
{
    //设置属性
//    public $logImg;
    public static $status=[0=>'上线',1=>'下线'];

    public $logImg='';
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','sort','status','logo'], 'required'],
            [['intro','logImg'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'sort' => '排序',
            'status' => '状态',
            'intro' => '简介',
            'logo' => '图片',

        ];
    }
    /**
     *
     */
}
