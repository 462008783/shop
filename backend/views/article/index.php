<?php
/* @var $this yii\web\View */
?>
<h1>文章列表</h1>
<br>

<?=\yii\bootstrap\Html::a("",['add'],['class'=>'btn btn-success glyphicon glyphicon-plus'])?>
<p>
<table class="table">
    <tr>
        <th>Id</th>
        <th>标题</th>
        <th>简介</th>
        <th>文章分类</th>
        <th>文章内容</th>
        <th>状态</th>
        <th>排序</th>
        <th>发布时间</th>
        <th>更新时间</th>
        <th>操作</th>
   </tr>
    <?php
    foreach ($model as $value):
    ?>
    <tr>
        <td><?=$value->id?></td>
        <td><?=$value->title?></td>
        <td><?=$value->intro?></td>
        <td><?=$value->cate->name?></td>
        <td><?=$value->content->detailes??""; ?></td>
        <td>
            <?php
            if ($value->status==0){
                echo \yii\helpers\Html::a('',['line','id'=>$value->id],['class'=>' glyphicon glyphicon-remove']);
            }else{
                echo \yii\helpers\Html::a('',['line','id'=>$value->id],['class'=>' glyphicon glyphicon-ok']);
            }
            ?>
        </td>
        <td><?=$value->sort?></td>
        <td><?=date("Y-m-d H:i:s",$value->created_at)?></td>
        <td><?=date("Y-m-d H:i:s",$value->updated_at)?></td>
        <td>
            <?=\yii\bootstrap\Html::a("",['edit','id'=>$value->id],['class'=>'btn btn-info btn-sm glyphicon glyphicon-pencil'])?>
            <?=\yii\bootstrap\Html::a("",['del','id'=>$value->id],['class'=>'btn btn-danger btn-sm glyphicon glyphicon-trash'])?>
        </td>



    </tr>


    <?php
    endforeach;
    ?>
</table>
</p>
<?= \yii\widgets\LinkPager::widget(['pagination' => $page]) ?>
