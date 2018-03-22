<?php
/**
 * Created by PhpStorm.
 * User: 秦鹍
 * Date: 2018/3/18
 * Time: 16:33
 */

namespace backend\components;


use creocoder\nestedsets\NestedSetsQueryBehavior;

class MenuQuery extends \yii\db\ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
}