<?php
/* @var $this yii\web\View */
?>
    <h1>管理员列表</h1>
    <br>
    <p>
        <?=\yii\bootstrap\Html::a("",['add'],['class'=>'btn btn-success glyphicon glyphicon-plus pull-left'])?>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>管理员</th>
            <th>状态</th>
            <th>最后登录时间</th>
            <th>最后登录IP</th>

            <th>操作</th>
        </tr>
        <?php
        foreach ($model as $value):
            ?>
            <tr>
                <td><?=$value->id?></td>
                <td><?=$value->username?></td>
                <td>
                    <?php
                    if ($value->status==0){
                        echo \yii\helpers\Html::a('',['#','id'=>$value->id],['class'=>' glyphicon glyphicon-remove']);
                    }else{
                        echo \yii\helpers\Html::a('',['#','id'=>$value->id],['class'=>' glyphicon glyphicon-ok']);
                    }
                    ?>
                </td>
                <td><?=date("Y-m-d H:i:s",$value->login_time)?></td>
                <td><?=date(long2ip($value->login_ip))?></td>
                <td>

                    <?=\yii\bootstrap\Html::a("",['edit','id'=>$value->id],['class'=>'btn btn-info btn-sm glyphicon glyphicon-pencil'])?>

                </td>
            </tr>
            <?php
        endforeach;
        ?>
    </table>
    </p>