<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article_details".
 *
 * @property int $id
 * @property string $detailes 文章内容
 * @property int $aeticle_id 文章Id
 */
class ArticleDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['detailes','article_id'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'detailes' => '文章内容',
            'article_id' => '文章Id',
        ];
    }
}
