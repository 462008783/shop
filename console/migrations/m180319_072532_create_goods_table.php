<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods`.
 */
class m180319_072532_create_goods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('goods', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->null()->comment('商品名称'),
            'brand_id' => $this->integer()->null()->comment('品牌id'),
            'cate_id' => $this->integer()->null()->comment('分类id'),
            'sn' => $this->integer()->null()->comment('商品货号'),
            'logo' => $this->string()->null()->comment('商品logo'),
            'market_price' => $this->decimal()->null()->comment('市场价格'),
            'shop_price' => $this->decimal()->null()->comment('本店价格'),
            'stock' => $this->integer()->null()->comment('库存'),
            'status' => $this->integer()->null()->comment('状态'),
            'sort' => $this->integer()->null()->comment('排序'),
            'insert_at' => $this->integer()->null()->comment('录入时间'),
            'update_at' => $this->integer()->null()->comment('修改时间'),
        ]);
        $this->createTable('goods_details',[
            'id' => $this->primaryKey(),
            'content' => $this->string()->comment('商品详情'),
            'goods_id' => $this->integer()->null()->comment('商品id'),
        ]);
        $this->createTable('goods_picture',[
           'id' => $this->primaryKey(),
            'path' => $this->string()->comment('图片地址'),
            'goods_id' => $this->integer()->null()->comment('商品id'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('goods');
        $this->dropTable('goods_details');
        $this->dropTable('goods_details');
    }
}
