<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods_details".
 *
 * @property int $id
 * @property string $content 商品详情
 * @property int $goods_id 商品id
 */
class GoodsDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id'], 'integer'],
            [['content'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '商品详情',
            'goods_id' => '商品id',
        ];
    }
}
