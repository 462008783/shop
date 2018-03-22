<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleCategory;
use backend\models\ArticleDetails;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

class ArticleController extends \yii\web\Controller
{

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

    /**文章列表显示
     * @return string
     */
    public function actionIndex()
    {
        // 得到数据
        $models = Article::find();

        //总的条数
        $count =$models->count();

        //分页对象
        $page =new Pagination([
            'pageSize' => 3,//每页显示条数
            'totalCount' => $count,
        ]);

        //查询分页后的数据
        $model=$models->offset($page->offset)->limit($page->limit)->all();

        //显示视图  分配数据
        return $this->render('index',compact('model',['page']));
    }


    /**文章添加
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        //创建数据模型
        $model = new Article();

        //创建分类模型
        $cate =new ArticleCategory();
        //得到分类数据
        $data =$cate::find()->asArray()->all();
        //二维转一维
        $cateArr = ArrayHelper::map($data,'id','name');

        //创建文章内容模型对象
        $content = new ArticleDetails();

        //判断是否POST
        if (\Yii::$app->request->isPost) {

            //绑定数据
            $model->load(\Yii::$app->request->post());

            //后台验证
            if ($model->validate()) {

                //绑定数据
                if ($model->save()) {

                    //文章内容数据绑定
                    $content->article_id=$model->id;
                    $content->load(\Yii::$app->request->post());

                    //后台验证
                    if ($content->validate()) {

                        //绑定数据
                        if ($content->save()) {

                            //提示信息
                            \Yii::$app->session->setFlash('success','添加成功');

                            //列表返回
                            return $this->redirect('index');
                        }
                    }else{

                        //TODO
                        var_dump($content->errors);exit;
                    }
                }
            }
        }

        //引入视图
        return $this->render('add',compact('model','cateArr','content'));

    }


    /**文章删除
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        //找到编辑对象
        $model = Article::findOne($id);

        //创建文章内容对象
        $content = ArticleDetails::find()->where(['article_id'=>$id])->one();

        //创建分类模型
        $cate =new ArticleCategory();
        //得到分类数据
        $data =$cate::find()->asArray()->all();
        //二维转一维
        $cateArr = ArrayHelper::map($data,'id','name');


        //判断是否POST
        if (\Yii::$app->request->isPost) {

            //绑定数据
            $model->load(\Yii::$app->request->post());

            //后台验证
            if ($model->validate()) {

                //绑定数据
                if ($model->save()) {

                    //文章内容数据绑定
                    $content->article_id=$model->id;
                    $content->load(\Yii::$app->request->post());

                    //后台验证
                    if ($content->validate()) {

                        //绑定数据
                        if ($content->save()) {

                            //提示信息
                            \Yii::$app->session->setFlash('success','编辑成功');

                            //列表返回
                            return $this->redirect('index');
                        }
                    }else{

                        //TODO
                        var_dump($content->errors);exit;

                    }
                }
            }
        }

        //引入视图
        return $this->render('add',compact('model','cateArr','content'));

    }


    /**文章删除
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDel($id)
    {
        //找到删除对象
        $del = Article::findOne($id)->delete();
        $con= ArticleDetails::find()->where(['article_id'=>$id])->one()->delete();

        //判断
        if ($del && $con) {
            \Yii::$app->session->setFlash('success','删除成功');
            //返回
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
        $line = Article::findOne($id);

        $line->status=$line->status==1?0:1;

        //保存
        if ($line->save()) {
            //提示信息
            \Yii::$app->session->setFlash('success','状态修改成功');

            //返回列表
            return $this->redirect('index');
        }
    }
}
