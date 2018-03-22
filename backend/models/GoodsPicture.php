<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods_picture".
 *
 * @property int $id
 * @property string $path 图片地址
 * @property int $goods_id 商品id
 */
class GoodsPicture extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_picture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id'], 'integer'],
            [['path'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => '商品图片',
            'goods_id' => '商品id',
        ];
    }
}
