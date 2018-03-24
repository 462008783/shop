<?php
/**
 * Created by PhpStorm.
 * User: 秦鹍
 * Date: 2018/3/24
 * Time: 19:52
 */

namespace backend\filters;


use yii\base\ActionFilter;

class RbacFilter extends ActionFilter
{
    public function  beforeAction($action)
    {

        //判断用户是否有权限
        if(! \Yii::$app->user->can($action->uniqueId)){
            $html=<<<HTML
<script>
window.history.go(-1);
</script>
HTML;

            \Yii::$app->session->setFlash('danger','权限不足');
            echo $html;
            return false;
        }
        return parent::beforeAction($action);
    }

}