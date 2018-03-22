<?php
/* @var $this yii\web\View */
?>
<h1>商品分类管理</h1>
<br>
<?=\yii\bootstrap\Html::a("",['add'],['class'=>'btn btn-success glyphicon glyphicon-plus'])?>
<table class="table">
    <tr>
        <td><?=\leandrogehlen\treegrid\TreeGrid::widget([
            'dataProvider' => $dataProvider,
            'keyColumnName' => 'id',
            'parentColumnName' => 'pid',
            'parentRootValue' => '0', //first parentId value
            'pluginOptions' => [
                'initialState' => 'collapsed',
            ],
            'columns' => [
                'name',
                'id',
                'intro',
                'pid',
                ['class' => 'yii\grid\ActionColumn']
            ]
        ]);
        ?>
        </td>
    </tr>

</table>



