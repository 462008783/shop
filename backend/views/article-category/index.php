<?php
/* @var $this yii\web\View */
?>
<h1>文章分类管理</h1>

<p>
    <a href="<?=\yii\helpers\Url::to(['add'])?>" class="btn btn-success glyphicon glyphicon-plus"></a>
<table class="table">
    <tr>
        <th>ID</th>
        <th>分类名称</th>
        <th>简介</th>
        <th>排序</th>
        <th>是否帮助类</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    <?php
        foreach ($model as $value):
    ?>
    <tr>
        <td><?=$value->id?></td>
        <td><?=$value->name?></td>
        <td><?=$value->intro?></td>
        <td><?=$value->sort?></td>
        <td>
            <?php
            if ($value->is_help==0){
                echo \yii\helpers\Html::a('',['lines','id'=>$value->id],['class'=>' glyphicon glyphicon-remove']);
            }else{
                echo \yii\helpers\Html::a('',['lines','id'=>$value->id],['class'=>' glyphicon glyphicon-ok']);
            }
            ?>
        </td><td>
            <?php
            if ($value->status==0){
                echo \yii\helpers\Html::a('',['line','id'=>$value->id],['class'=>' glyphicon glyphicon-remove']);
            }else{
                echo \yii\helpers\Html::a('',['line','id'=>$value->id],['class'=>' glyphicon glyphicon-ok']);
            }
            ?>
        </td>
        <td>
            <a href="<?=\yii\helpers\Url::to(['edit','id'=>$value->id])?>" class="btn btn-info btn-sm glyphicon glyphicon-pencil"></a>
            <a href="<?=\yii\helpers\Url::to(['del','id'=>$value->id])?>" class="btn btn-danger btn-sm glyphicon glyphicon-trash"></a>
        </td>
    </tr>
    <?php
        endforeach;
    ?>
</table>
</p>
<?= \yii\widgets\LinkPager::widget(['pagination' => $page]) ?>