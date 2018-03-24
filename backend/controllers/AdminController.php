<?php

namespace backend\controllers;

use backend\models\Admin;
use backend\models\AuthItem;
use \backend\models\LoginForm;
use function Sodium\compare;
use yii\helpers\ArrayHelper;

class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {

        return $this->render('index');

    }

    public function actionShow()
    {
        //拿到数据
        $model = Admin::find()->all();

        //数据分配  引入视图
        return $this->render('show',compact('model'));

    }

    /**管理员登录
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        //创建模型
        $model = new LoginForm();

        //POST提交
        if (\Yii::$app->request->isPost) {

            //数据绑定
            $model->load(\Yii::$app->request->post());


            //后台验证
            if ($model->validate()) {

                $admin = Admin::findOne(['username'=>$model->username,'status'=>1]);

                //判断用户名
                if ($admin) {

                    //验证密码
                    if (\Yii::$app->security->validatePassword($model->password,$admin->password_hash)) {

                        //插件登录
                        \Yii::$app->user->login($admin,$model->rememberMe?3600*24*7:0);

                        \Yii::$app->session->setFlash('success','登录成功');

                        return $this->redirect(['admin/index']);

                    }else{

                        //错误提示
                        $model->addError('password','密码不正确');
                    }

                }else{

                    //错误提示
                    $model->addError('username','帐号输入错误或权限不够');
                }

            }else{

                // TODO
                var_dump($model->errors);exit;
            }
        }



        //视图引入
        return $this->render('login',compact('model'));
    }


    /**管理员添加
     * @return string
     */
    public function actionAdd()
    {
        //创建模型对象
        $model =new Admin();
        //创建角色模型对象
        $item = new AuthItem();

        //加载场景
        $model->setScenario('add');

        //实例化组件
        $auth = \Yii::$app->authManager;
        //找到所有角色
        $roles =$auth->getRoles();
        //找到角色名
        $roleArr =ArrayHelper::map($roles,'name','name');


        //判断post 后台验证
        if ( $model->load(\Yii::$app->request->post()) && $model->validate()) {
            //密码加密
            $model->password_hash=\Yii::$app->security->generatePasswordHash($model->password_hash);

            //设置令牌
            $model->auth_key=\Yii::$app->security->generateRandomString();

            //保存
            if ($model->save()) {
                //绑定数据
                $item->load(\Yii::$app->request->post());

                //通过角色名称找到角色对象
                $role= $auth->getRole($item->name);

                //将用户指派给角色
                $user = $auth->assign($role,$model->id);

                //提示信息
                \Yii::$app->session->setFlash('success','添加管理员成功');
                $this->redirect('index');
            }else{
                //TODO
                var_dump($model->errors);exit;
            }
        }

        return $this->render('add',compact('model','item','roleArr'));

    }


    /**管理员编辑
     * @param $id
     * @return string
     */
    public function actionEdit($id)
    {
        //找到编辑对象
        $model =Admin::findOne($id);
        $password = $model->password_hash;
        $model->setScenario('edit');

        //判断post 后台验证
        if ( $model->load(\Yii::$app->request->post()) && $model->validate()) {

            //判断是否修改密码
            $model->password_hash=$model->password_hash?\Yii::$app->security->generatePasswordHash($model->password_hash):$password;

            //设置令牌
            $model->auth_key=\Yii::$app->security->generateRandomString();

            //保存
            if ($model->save()) {

                //提示信息
                \Yii::$app->session->setFlash('success','编辑成功');
                 return $this->redirect('show');
                }



            }


        $model->password_hash=null;
        return $this->render('edit',compact('model','item','roleArr'));

    }

    /**管理员退出
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->goHome();
    }


}
