<?php

namespace backend\controllers;

use backend\models\AuthItem;
use Codeception\Module\Yii1;

class PermissionController extends \yii\web\Controller
{
    /**
     * 权限显示
     * @return string
     */
    public function actionIndex()
    {
        //创建auth对象
        $auth = \Yii::$app->authManager;

        //找到所有权限
        $model = $auth->getPermissions();

        return $this->render('index',compact('model'));
    }


    /**
     * 权限添加
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        //创建模型对象
        $model =new AuthItem();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {

            //创建auth对象
            $auth = \Yii::$app->authManager;

            //创建权限 权限名称
            $pre = $auth->createPermission($model->name);

            //描述
            $pre->description=$model->description;

            //权限入库 保存数据
            if ($auth->add($pre)) {

                \Yii::$app->session->setFlash('success','添加权限:'.$model->name.$model->description.'成功！');
                return $this->refresh();
            }

        }
        //引入视图 数据导入
        return $this->render('add',compact('model'));
    }


    /**
     * 权限编辑
     * @param $name
     * @return string|\yii\web\Response
     */
    public function actionEdit($name)
    {

        //找到编辑对象
        $model = AuthItem::findOne($name);

        //绑定数据  后台验证
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {

            //创建对象
            $auth = \Yii::$app->authManager;

            //得到权限
            $per = $auth->getPermission($model->name);

            //权限描述
            $per->description=$model->description;


            //权限入库
            if ($auth->update($model->name,$per)) {

                \Yii::$app->session->setFlash('success','修改权限成功！');
                return $this->redirect('index');
            }




        }


        //引入视图
        return $this->render('edit',compact('model'));

    }

    /**
     * 权限删除
     * @param $name
     * @return \yii\web\Response
     */
    public function actionDel($name)
    {
        //创建auth对象
        $auth = \Yii::$app->authManager;

        //找到权限对象
        $per = $auth->getPermission($name);

        //删除
        if ($auth->remove($per)) {
            \Yii::$app->session->setFlash('success','删除权限成功！');
            return $this->redirect('index');
        }
    }
}
