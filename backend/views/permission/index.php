<h1>品牌展示</h1><br>
<?=\yii\bootstrap\Html::a("",['add'],['class'=>'btn btn-success glyphicon glyphicon-plus'])?>
<table class="table">
    <tr>
        <th>权限</th>
        <th>简介</th>
        <th>编辑</th>
    </tr>
    <?php
    foreach ($model as $value):
        ?>
        <tr>
            <td><?=strpos($value->name,'/')!==false?'·····'.$value->name:$value->name ?></td>
            <td><?=$value->description?></td>
            <td>
                <?=\yii\bootstrap\Html::a("",['edit','name'=>$value->name],['class'=>'btn btn-info btn-sm glyphicon glyphicon-pencil'])?>
                <?=\yii\bootstrap\Html::a("",['del','name'=>$value->name],['class'=>'btn btn-danger btn-sm glyphicon glyphicon-trash'])?>
            </td>
        </tr>
        <?php
    endforeach;
    ?>
</table>