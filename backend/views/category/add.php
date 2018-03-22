<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */
/* @var $form ActiveForm */
?>
<div class="category-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'pid')->hiddenInput(['value'=>0]) ?>
        <?= \liyuze\ztree\ZTree::widget([
            'setting' => '{
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "pid",
                    }
                },
                callback: {
                    onClick: onClick
                }
            }',
            'nodes' => $cateJson,
        ]);
        ?>
        <?= $form->field($model, 'intro') ?>
    
        <div class="form-group">
            <?= Html::submitButton('提交  ', ['class' => 'btn btn-primary']) ?>
            <?=\yii\bootstrap\Html::a('返回',['index'],['class'=>'btn btn-info'])?>
        </div>

<?php
    ActiveForm::end();
//定义jS代码块
$js=<<<JS
var treeObj = $.fn.zTree.getZTreeObj("w1");//得到ztree对象
var node = treeObj.getNodeByParam("id", "$model->pid", null);//找到节点当前对象
treeObj.selectNode(node);//选中当前节点
$('#category-pid').val($model->pid);
treeObj.expandAll(true);//展开方法
JS;
$this->registerJs($js);
    ?>

</div><!-- category-add -->
<script>
    function onClick(e,treeId, treeNode) {
        $("#category-pid").val(treeNode.id);

//        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
//        zTree.expandNode(treeNode);
    }
</script>
