<?php
/**
 * Created by PhpStorm.
 * User: 秦鹍
 * Date: 2018/3/24
 * Time: 19:57
 */

namespace backend\controllers;


use backend\filters\RbacFilter;
use yii\web\Controller;

class BaseController extends Controller
{
    public function behaviors()
    {
        return [
            'rbac'=>[
                'class'=>RbacFilter::className(),

            ]
        ];
    }

}