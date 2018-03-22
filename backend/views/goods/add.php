<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Goods */
/* @var $form ActiveForm */
//echo date("Ymd",time());
?>
<div class="goods-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?=$form->field($model,'logo')->widget(manks\FileInput::className(),[])?>
    <?= $form->field($model, 'img')->widget(manks\FileInput::className(), [
        'clientOptions' => [
            'pick' => [
                'multiple' => true,
            ],
            // 'server' => Url::to('upload/u2'),
            // 'accept' => [
            // 	'extensions' => 'png',
            // ],
        ],
    ]);?>
        <?= $form->field($model, 'brand_id')->dropDownList($brandArr,['prompt'=>"请选择品牌..."]) ?>
        <?= $form->field($model, 'cate_id')->dropDownList($cateArr,['prompt'=>"请选择分类..."]) ?>
        <?= $form->field($model, 'market_price') ?>
        <?= $form->field($model, 'shop_price') ?>
        <?= $form->field($model, 'sn') ?>
        <?= $form->field($model, 'stock') ?>
        <?= $form->field($model, 'sort')->textInput(['value'=>200]) ?>
        <?= $form->field($details,'content')->widget('kucha\ueditor\UEditor',[]);?>
        <?= $form->field($model, 'status')->radioList([0=>'未上线',1=>'上线'],['value'=>1]) ?>

        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- goods-add -->
