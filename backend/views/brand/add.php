<?php

$form =\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
//echo $form->field($model,'logImg')->fileInput();
echo $form->field($model,'logo')->widget(manks\FileInput::className(),[]);
echo $form->field($model,'sort')->textInput(['maxlength' => true,'value'=>100]);

echo $form->field($model,'status')->inline()->radioList(['下线','上线'],['value'=>1]);
echo $form->field($model,'intro')->textarea();
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-info']);
$form =\yii\bootstrap\ActiveForm::end();