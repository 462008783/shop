<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "goods".
 *
 * @property int $id
 * @property string $name 商品名称
 * @property int $brand_id 品牌id
 * @property int $cate_id 分类id
 * @property int $sn 商品货号
 * @property string $logo 商品logo
 * @property string $market_price 市场价格
 * @property string $shop_price 本店价格
 * @property int $stock 库存
 * @property int $status 状态
 * @property int $sort 排序
 * @property int $insert_at 录入时间
 * @property int $update_at 修改时间
 */
class Goods extends \yii\db\ActiveRecord
{
    public $img;

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


    /**设置规则
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','brand_id', 'cate_id', 'market_price','shop_price','stock', 'status', 'sort','logo','img'], 'required'],
            [['brand_id','cate_id','stock', 'sort','created_at', 'updated_at','market_price','shop_price'],'number'],
            [['sn'],'unique'],
        ];
    }

    /**设置label
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'brand_id' => '品牌',
            'cate_id' => '分类',
            'sn' => '货号',
            'logo' => 'logo',
            'market_price' => '市场价格',
            'shop_price' => '本店价格',
            'stock' => '库存',
            'status' => '状态',
            'sort' => '排序',
        ];
    }


    public function getBrand()
    {
        return $this->hasOne(Brand::className(),['id'=>'brand_id']);

    }
    public function getCate()
    {
        return $this->hasOne(Category::className(),['id'=>'cate_id']);
    }
}
