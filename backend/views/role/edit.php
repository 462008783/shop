<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\authItem */
/* @var $form ActiveForm */
?>
<div class="permission-add">

        <?php $form = ActiveForm::begin(); ?>
    <?php
//    var_dump($model);exit;
    ?>
        <?= $form->field($model, 'name')->textInput(['disabled'=>'']) ?>
        <?= $form->field($model, 'description')->textarea() ?>
        <?= $form->field($model, 'permission')->inline()->checkboxList($perArr) ?>
    
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- permission-add -->
