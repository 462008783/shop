<?php
/* @var $this yii\web\View */
?>
<h1>商品列表</h1>
<br>
    <p>
<?=\yii\bootstrap\Html::a("",['add'],['class'=>'btn btn-success glyphicon glyphicon-plus pull-left'])?>
    <form class="form-inline pull-right">
    <select class="form-control" name="">
        <option value="#">请选择状态</option>
        <option value="0">未上线</option>
        <option value="1">上线</option>
    </select>
        <div class="form-group">
            <label class="sr-only" for="exampleInputEmail3"></label>
            <input type="text" class="form-control" id="exampleInputEmail3" placeholder="最低价" name="minPrice" size="6" value="<?=\Yii::$app->request->get('minPrice')?>">
        </div>
        -
        <div class="form-group">
            <label class="sr-only" for="exampleInputPassword3"></label>
            <input type="text" class="form-control" id="exampleInputPassword3" placeholder="最高价"  name="maxPrice" size="6" value="<?=\Yii::$app->request->get('maxPrice')?>" >
        </div>

        <div class="form-group">
            <label class="sr-only" for="exampleInputPassword3"></label>
            <input type="text" class="form-control" id="exampleInputPassword3" placeholder="商品名称或货号" name="keyword" value="<?=\Yii::$app->request->get('keyword')?>" >
        </div>
        <button type="submit" class="btn btn-default btn-info glyphicon glyphicon-search"></button>
    </form>
<table class="table">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>logo</th>
        <th>货号</th>
        <th>品牌</th>
        <th>分类</th>
        <th>市场价格</th>
        <th>本店价格</th>
        <th>库存</th>
        <th>状态</th>
        <th>排序</th>
        <th>录入时间</th>
        <th>修改时间</th>
        <th>操作</th>
    </tr>
    <?php
        foreach ($model as $value):
    ?>
    <tr>
        <td><?=$value->id?></td>
        <td><?=$value->name?></td>
        <td><?php
            $logPath = strpos($value->logo,"http://")===false?"/".$value->logo:$value->logo;
            echo \yii\helpers\Html::img($logPath,['height'=>30]);
            ?></td>
        <td><?=$value->sn?></td>
        <td><?=$value->brand->name?></td>
        <td><?=$value->cate->name?></td>
        <td><?=$value->market_price?></td>
        <td><?=$value->shop_price?></td>
        <td><?=$value->stock?></td>
        <td>
            <?php
            if ($value->status==0){
                echo \yii\helpers\Html::a('',['#','id'=>$value->id],['class'=>' glyphicon glyphicon-remove']);
            }else{
                echo \yii\helpers\Html::a('',['#','id'=>$value->id],['class'=>' glyphicon glyphicon-ok']);
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
<?=\yii\widgets\LinkPager::widget([
    'pagination' => $pagination,
])?>