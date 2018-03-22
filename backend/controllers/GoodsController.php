<?php

namespace backend\controllers;

use backend\models\Admin;
use backend\models\Brand;
use backend\models\Category;
use backend\models\Goods;
use backend\models\GoodsDetails;
use backend\models\GoodsPicture;
use yii\data\Pagination;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\User;

class GoodsController extends \yii\web\Controller
{

    /**列表显示
     * @return string
     */
    public function actionIndex()
    {

        try{
            // 创建一个 DB 查询来获得所有 status 为 1 的文章
            $query = Goods::find();

            $minPrice = \Yii::$app->request->get('minPrice');
            $maxPrice = \Yii::$app->request->get('maxPrice');
            $keyword = \Yii::$app->request->get('keyword');
            $status = \Yii::$app->request->get('status');


            if ($minPrice!="") {
                $query->andWhere("shop_price>={$minPrice}");
            }
            if ($maxPrice!="") {
                $query->andWhere("shop_price<={$maxPrice}");
            }
            if ($keyword!="") {
                $query->andWhere("name like '%{$keyword}%' or sn like '%{$keyword}%'");
            }
            if ($status==="1" || $status==="0") {
                $query->andWhere(["status"=>$status]);
            }



            // 得到文章的总数（但是还没有从数据库取数据）
            $count = $query->count();

            // 使用总数来创建一个分页对象
            $pagination = new Pagination([
                'totalCount' => $count,
                'pageSize' => 3,
            ]);

            // 使用分页对象来填充 limit 子句并取得文章数据
            $model = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
            return $this->render('index',compact('pagination','model'));//显示列表 数据分配

        }catch(Exception $exception){

            \Yii::$app->session->setFlash('danger', "搜索不能为空");//提示
            return $this->redirect('index');//刷新界面
        }

    }

    /**商品添加
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        //创建新的数据模型
        $model = new Goods();
        //创建详情表模型
        $details = new GoodsDetails();

        //得到品牌数据
        $brand = Brand::find()->asArray()->all();
        //二维转一维
        $brandArr = ArrayHelper::map($brand,'id','name');

        //得到分类数据
        $cate = Category::find()->orderBy('tree','lft')->asArray()->all();
        $arr=[];
        //循环保存
        foreach ($cate as $value){

            $value['name']=str_repeat("··",$value['pid']).$value["name"];
            $arr[]=$value;
        }
        //二维转一维
        $cateArr = ArrayHelper::map($arr,'id','name');

        //创建request
        $request=\Yii::$app->request;
        //判断POST提交
        if ($request->isPost) {

            //数据绑定
            $model->load($request->post());//商品表
            $details->load($request->post());//详情表

            //后台验证
            if ($model->validate() && $details->validate()) {

                //判断货号是否存在
                if ($model->sn=="") {
                    $time =strtotime(date('Ymd'));//时间戳
                    $count = Goods::find()->where([">=",'created_at',$time])->count();//当天商品总量
                    $counts = sprintf("%03d",$count);
                    $model->sn=date("Ymd").$counts+1;//商品货号
                }

                if ($model->save()) {//保存数据商品表

                        $details->goods_id=$model->id;//详情表获取goods_id
                        $details->save();//保存数据详情表

                            //多图循环保存
                            foreach ($model->img as $value){
                                $pictures =new GoodsPicture();
                                $pictures->goods_id=$model->id;//商品id
                                $pictures->path=$value;//图片地址
                                $pictures->save();//保存数据图片表
                            }

                         \Yii::$app->session->setFlash('success','添加成功');
                         return $this->redirect('index');

                }

            }else{
                //TODO
                var_dump($model->errors);exit;
            }

        }
        return $this->render('add',compact('model','brandArr','cateArr','details'));//引入视图
    }


    /**商品编辑
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        //找到商品表编辑对象
        $model = Goods::findOne($id);
        //找到详情表编辑对象
        $details = GoodsDetails::findOne(['goods_id'=>$id]);

        //图片表编辑对象
        $image =GoodsPicture::find()->where(['goods_id'=>$id])->asArray()->all();
        //二维数组转成指定字段的一维数组
        $images = array_column($image,'path');

        //赋值
        $model->img =$images;


        //得到品牌数据
        $brand = Brand::find()->asArray()->all();
        //二维转一维
        $brandArr = ArrayHelper::map($brand,'id','name');

        //得到分类数据
        $cate = Category::find()->orderBy('tree','lft')->asArray()->all();
        $arr=[];
        //循环保存
        foreach ($cate as $value){

            $value['name']=str_repeat("··",$value['pid']).$value["name"];
            $arr[]=$value;
        }
        //二维转一维
        $cateArr = ArrayHelper::map($arr,'id','name');

        //创建request
        $request=\Yii::$app->request;
        //判断POST提交
        if ($request->isPost) {

            //数据绑定
            $model->load($request->post());//商品表
            $details->load($request->post());//详情表

            //后台验证
            if ($model->validate() && $details->validate()) {

                //判断货号是否存在
                if ($model->sn=="") {
                    $time =strtotime(date('Ymd'));//时间戳
                    $count = Goods::find()->where([">=",'created_at',$time])->count();//当天商品总量
                    $counts = sprintf("%03d",$count);
                    $model->sn=date("Ymd").$counts+1;//商品货号
                }

                if ($model->save()) {//保存数据商品表

                    $details->goods_id=$model->id;//详情表获取goods_id
                    $details->save();//保存数据详情表

                    //图片保存之前删除数据库数据
                    GoodsPicture::deleteAll(['goods_id'=>$id]);
                    //多图循环保存
                    foreach ($model->img as $value){
                        $pictures =new GoodsPicture();
                        $pictures->goods_id=$model->id;//商品id
                        $pictures->path=$value;//图片地址
                        $pictures->save();//保存数据图片表
                    }

                    \Yii::$app->session->setFlash('success','添加成功');
                    return $this->redirect('index');

                }

            }else{
                //TODO
                var_dump($model->errors);exit;
            }
        }
        return $this->render('add',compact('model','brandArr','cateArr','details'));//引入视图
    }


    /**商品删除
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDel($id)
    {
        //找到删除对象
        $goods = Goods::findOne($id)->delete();
        $details = GoodsDetails::findOne(['goods_id'=>$id])->delete();
        $picture = GoodsPicture::deleteAll(['goods_id'=>$id]);
        //判断返回
        if ($goods && $details && $picture){
            \Yii::$app->session->setFlash('danger','删除成功');
            return $this->redirect('index');
        }

    }


    /**富文本
     * @return array
     */
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
            ]
        ];
    }



}
