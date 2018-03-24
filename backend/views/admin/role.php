<?php
/**
 * Created by PhpStorm.
 * User: 秦鹍
 * Date: 2018/3/24
 * Time: 17:05
 */
/** @var $this \yii\web\View */
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'username');
echo $form->field($models,'name')->inline()->checkboxList($roleArr );
echo \yii\bootstrap\Html::submitButton('提交',['class' => 'btn btn-primary']);
$form = \yii\bootstrap\ActiveForm::end();