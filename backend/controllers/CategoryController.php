<?php

namespace backend\controllers;

use backend\models\Category;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\helpers\Json;

class CategoryController extends \yii\web\Controller
{

    /**商品列表显示
     * Lists all Tree models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Category::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
        return $this->render('index',compact('dataProvider'));//引入视图 数据分配
    }


    /**商品分类添加
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $model = new Category();//创建模型
        $cate = Category::find()->asArray()->all();//查询所有数据
        $cate[] =['id'=>0,'name'=>'一级分类','pid'=>0];//添加一个顶级分类
        $cateJson = Json::encode($cate);//转换json字符串

        if (\Yii::$app->request->isPost) {//判断是否post提交

            $model->load(\Yii::$app->request->post());//绑定数据

            if ($model->validate()) {//后台验证

                if ($model->pid == 0) {//一级分类

                    $model->makeRoot();//创建一级分类
                    \Yii::$app->session->setFlash('success', '添加一级分类：' . $model->name . '成功');//提示
                    return $this->refresh();//刷新界面

                } else {//添加子类

                    $catePid = Category::findOne($model->pid);//找到父类
                    $model->prependTo($catePid);//添加到父类方法中
                    \Yii::$app->session->setFlash('success', "添加{$catePid->name}的子分类：" . $model->name . "成功");//提示
                    return $this->refresh();//刷新界面
                }
            } else {
                //TODO
                var_dump($model->errors);
                exit;
            }

        }
         return $this->render("add",compact('model','cateJson'));//引入视图 数据导入

    }


    /**商品分类编辑
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {

            $model =Category::findOne($id);//查找编辑对象
            $cate = Category::find()->asArray()->all();//查询所有数据\
            $cate[] =['id'=>0,'name'=>'一级分类','pid'=>0];//添加一个顶级分类
            $cateJson = Json::encode($cate);//转换json字符串

            if (\Yii::$app->request->isPost) {//判断是否post提交

                $model->load(\Yii::$app->request->post());//绑定数据

                if ($model->validate()) {//后台验证
                //异常捕获
                try{
                    if ($model->pid == 0) {//一级分类

                        $model->makeRoot();//创建一级分类
                        \Yii::$app->session->setFlash('success', '编辑一级分类：' . $model->name . '成功');//提示
                        return $this->refresh();//刷新界面

                    } else {//添加子类

                        $catePid = Category::findOne($model->pid);//找到父类
                        $model->prependTo($catePid);//添加到父类方法中
                        \Yii::$app->session->setFlash('success', "编辑{$catePid->name}的子分类：" . $model->name . "成功");//提示
                        return $this->redirect('index');//刷新界面
                    }
                }catch (Exception $exception){

                    \Yii::$app->session->setFlash('success', "不能移动到本类子类中去");//提示
                    return $this->redirect('index');//刷新界面
                }

            } else {
                    //TODO
                    var_dump($model->errors);
                    exit;
            }
        }



        return $this->render("add",compact('model','cateJson'));//引入视图 数据导入
    }


    /**商品分类删除
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        Category::findOne($id)->deleteWithChildren();
        \Yii::$app->session->setFlash('success','删除成功');
                    //返回
                    return $this->redirect('index');
    }

    /**分类删除
     * @param $id
     * @return \yii\web\Response
     */
//    public function actionDelete($id)
//    {
//        $cate =Category::findOne($id);
//        if ($cate->pid==0) {
//            \Yii::$app->session->setFlash('success', "一级分类不能删除");//提示
//            return $this->redirect('index');//刷新界面
//        }
//        $cates  = Category::find()->where(['pid'=>$id])->all() ;//查找是否有pid等于$id
//
//        if (!$cates) {//判断如果没有子节点就删除
//            if (Category::findOne($id)->delete()){
//                    \Yii::$app->session->setFlash('success','删除成功');
//                    //返回
//                    return $this->redirect('index');
//            }
//        }else{//判断如果有子节点就删除
//            \Yii::$app->session->setFlash('success', "此节点下有分类");//提示
//            return $this->redirect('index');//刷新界面
//        }
//    }
}
