<?php

namespace backend\controllers;



use backend\models\ArticleCategory;
use yii\data\Pagination;

class ArticleCategoryController extends \yii\web\Controller
{
    /**文章分类列表显示
     * @return string
     */
    public function actionIndex()
    {
        // 得到数据
        $models = ArticleCategory::find();

        //总的条数
        $count =$models->count();

        //分页对象
        $page =new Pagination([
            'pageSize' => 1,//每页显示条数
            'totalCount' => $count,
        ]);

        //查询分页后的数据
        $model=$models->offset($page->offset)->limit($page->limit)->all();

        //显示视图  分配数据
        return $this->render('index',compact('model',['page']));
    }


    /**文章分类添加
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        //创建模型对象
        $model = new ArticleCategory();

        //创建reques对象
        $requset = \Yii::$app->request;

        //判断是否post
        if ($requset->isPost) {

            //绑定数据
            $model->load($requset->post());

            //后台验证
            if ($model->validate()) {

                //保存数据
                if ($model->save()) {

                    //提示信息
                    \Yii::$app->session->setFlash('success','添加成功');

                    //返回
                    return $this->redirect('index');
                }
            }
        }


        //引入视图
        return $this->render('add',compact('model'));

    }


    /**文章分类编辑
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        //创建模型对象
        $model = ArticleCategory::findOne($id);

        //创建reques对象
        $requset = \Yii::$app->request;

        //判断是否post
        if ($requset->isPost) {

            //绑定数据
            $model->load($requset->post());

            //后台验证
            if ($model->validate()) {

                //保存数据
                if ($model->save()) {

                    //提示信息
                    \Yii::$app->session->setFlash('success','添加成功');

                    //返回
                    return $this->redirect('index');
                }
            }else{

            }
        }


        //引入视图
        return $this->render('add',compact('model'));

    }


    /**分类列表删除
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDel($id)
    {
        //找到删除对象
        $del = ArticleCategory::findOne($id)->delete();

        //判断
        if ($del) {
            //提示
             \Yii::$app->session->setFlash('success','删除成功');

             return $this->redirect('index');
        }
    }


    /**状态
     * @param $id
     * @return \yii\web\Response
     */
    public function actionLine($id)
    {
        //找到编辑对象
        $line = ArticleCategory::findOne($id);

        $line->status=$line->status==1?0:1;

        //保存
        if ($line->save()) {
            //提示信息
            \Yii::$app->session->setFlash('success','状态修改成功');

            //返回列表
            return $this->redirect('index');
        }
    }

    /**是否帮助
     * @param $id
     * @return \yii\web\Response
     */
    public function actionLines($id)
    {
        //找到编辑对象
        $line = ArticleCategory::findOne($id);

        $line->is_help=$line->is_help==1?0:1;

        //保存
        if ($line->save()) {
            //提示信息
            \Yii::$app->session->setFlash('success','状态修改成功');

            //返回列表
            return $this->redirect('index');
        }
    }
}
