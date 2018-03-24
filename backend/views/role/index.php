<h1>角色列表</h1><br>
<?=\yii\bootstrap\Html::a("",['add'],['class'=>'btn btn-success glyphicon glyphicon-plus'])?>
<table class="table">
    <tr>
        <th>权限</th>
        <th>简介</th>
        <th>权限</th>
        <th>编辑</th>
    </tr>
    <?php
    foreach ($model as $value):
        ?>
        <tr>
            <td><?=strpos($value->name,'/')!==false?'·····'.$value->name:$value->name ?></td>
            <td><?=$value->description?></td>
            <td><?php
                    //得到所有权限
                    $auth = Yii::$app->authManager;
                    //角色名得到所属权限
                    $per = $auth->getPermissionsByRole($value->name);
                    $html='';
                    //循环拿到角色权限
                    foreach ($per as $values){
                        $html .= $values->description.',';
                    }
                    //去掉，
                    $html = trim($html,',');
                    echo $html;
                ?></td>
            <td>
                <?=\yii\bootstrap\Html::a("",['edit','name'=>$value->name],['class'=>'btn btn-info btn-sm glyphicon glyphicon-pencil'])?>
                <?=\yii\bootstrap\Html::a("",['del','name'=>$value->name],['class'=>'btn btn-danger btn-sm glyphicon glyphicon-trash'])?>
            </td>
        </tr>
        <?php
    endforeach;
    ?>
</table>