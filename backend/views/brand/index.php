<h1>品牌展示</h1><br>
<?=\yii\bootstrap\Html::a("",['add'],['class'=>'btn btn-success glyphicon glyphicon-plus'])?>
<table class="table">
    <tr>
        <td>ID</td>
        <td>商品名称</td>
        <td>Logo</td>
        <td>排序</td>
        <td>简介</td>
        <td>状态</td>
        <td>操作</td>
    </tr>
    <?php
    foreach ($model as $value):
    ?>
        <tr>
            <td><?=$value->id?></td>
            <td><?=$value->name?></td>
            <td><?php
                    $logPath = strpos($value->logo,"http://")===false?"/".$value->logo:$value->logo;
                    echo \yii\helpers\Html::img($logPath,['height'=>40]);
                ?></td>
            <td><?=$value->sort?></td>
            <td><?=$value->intro?></td>
            <td>
                <?php
                    if ($value->status==0){
                        echo \yii\helpers\Html::a('',['line','id'=>$value->id],['class'=>' glyphicon glyphicon-remove']);
                    }else{
                        echo \yii\helpers\Html::a('',['line','id'=>$value->id],['class'=>' glyphicon glyphicon-ok']);
                    }
                ?>
            </td>
            <td>
                <?=\yii\bootstrap\Html::a("",['edit','id'=>$value->id],['class'=>'btn btn-info btn-sm glyphicon glyphicon-pencil'])?>
                <?=\yii\bootstrap\Html::a("",['del','id'=>$value->id],['class'=>'btn btn-danger btn-sm glyphicon glyphicon-trash'])?>
            </td>
        </tr>
    <?php
    endforeach;
    ?>
</table>
<?= \yii\widgets\LinkPager::widget(['pagination' => $page]) ?>