<?php

namespace backend\controllers;

use backend\models\AuthItem;
use Codeception\Module\Yii1;
use yii\helpers\ArrayHelper;

class RoleController extends \yii\web\Controller
{
    /**
     * 角色显示
     * @return string
     */
    public function actionIndex()
    {
        //创建auth对象
        $auth = \Yii::$app->authManager;

        //找到所有权限
        $model = $auth->getRoles();

        return $this->render('index',compact('model'));
    }


    /**
     * 角色添加
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        //创建模型对象
        $model =new AuthItem();

        //创建auth对象
        $auth = \Yii::$app->authManager;

        //得到所有权限数据
        $per = $auth->getPermissions();

        //二维转一维
        $perArr =ArrayHelper::map($per,'name','description');

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {

//            var_dump($model->permission);exit;


            //创建角色 角色名称
            $role = $auth->createRole($model->name);

            //描述
            $role->description=$model->description;

            //角色入库 保存数据
            if ($auth->add($role)) {

                //判断是否添加权限
                if ($model->permission) {

                    //循环给角色添加角色
                    foreach ($model->permission as $valueName){

                        //通过名称得到对象
                        $value = $auth->getPermission($valueName);
                        //给角色添加权限
                        $auth->addChild($role,$value);
                    }
                }

                //提示
                \Yii::$app->session->setFlash('success','添加角色:'.$model->name.'成功！');
                return $this->refresh();
            }else{
                //TODO
                var_dump($model->errors);exit;
            }

        }
        //引入视图 数据导入
        return $this->render('add',compact('model','perArr'));
    }


    /**
     * 角色编辑
     * @param $name
     * @return string|\yii\web\Response
     */
    public function actionEdit($name)
    {
        //创建模型对象
        $model =AuthItem::findOne($name);

        //创建auth对象
        $auth = \Yii::$app->authManager;

        //得到所有权限数据
        $per = $auth->getPermissions();
        //二维转一维
        $perArr =ArrayHelper::map($per,'name','description');

        //得到当前角色所所有权限
        $roleName = $auth->getPermissionsByRole($name);
        //得到所有key值
        $model->permission=array_keys($roleName);

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {

            //拿到角色
            $role = $auth->getRole($model->name);

            //描述
            $role->description=$model->description;

            //角色入库 保存数据
            if ($auth->update($model->name,$role)) {

                //判断是否添加权限
                if ($model->permission) {

                    //添加前删除角色所有权限
                    $auth->removeChildren($role);
                    //循环给角色添加角色
                    foreach ($model->permission as $valueName){

                        //通过名称得到对象
                        $value = $auth->getPermission($valueName);
                        $auth->addChild($role,$value);
                    }
                }

                //提示
                \Yii::$app->session->setFlash('success','添加角色:'.$model->name.'成功！');
                return $this->redirect('index');
            }else{
                //TODO
            var_dump($model->errors);exit;
            }
        }
        //引入视图 数据导入
        return $this->render('edit',compact('model','perArr'));
    }

    /**
     * 角色删除
     * @param $name
     * @return \yii\web\Response
     */
    public function actionDel($name)
    {
        //创建auth对象
        $auth = \Yii::$app->authManager;

        //找到角色对象
        $role = $auth->getRole($name);

        //删除
        if ($auth->remove($role)) {
            \Yii::$app->session->setFlash('success','删除角色'.$name.'成功！');
            return $this->redirect('index');
        }
    }
}
