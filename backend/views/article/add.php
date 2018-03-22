<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Article */
/* @var $form ActiveForm */
?>
<div class="article-add">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'cate_id')->dropDownList($cateArr) ?>
        <?= $form->field($model, 'intro') ?>
        <?= $form->field($content,'detailes')->widget('kucha\ueditor\UEditor',[]);?>
        <?= $form->field($model, 'sort')->textInput(['value'=>100]) ?>
        <?= $form->field($model, 'status')->radioList([0=>'未激活',1=>'激活'],['value'=>1]) ?>
    
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- article-add -->
