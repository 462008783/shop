<?php
namespace backend\controllers;

use backend\models\Admin;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        $request =Yii::$app->request;
        if ($request->isPost) {
            $model->load($request->post());

            $admin=Admin::find()->where(['username'=>$model->username])->one();

            //判断用户是否存在
            if ($admin) {
                $admin1=Admin::find()->where(['password'=>$model->password])->one();

                //判断密码是否正确
                if (\Yii::$app->security->validatePassword($model->password,$admin->password)) {


                    //通过user组件登录
                    \Yii::$app->user->login($admin);

                    //跳转首页
                    \Yii::$app->session->setFlash('success','登录成功');
                    return $this->redirect(['brand/index']);

                }else{
                    $model->addError('password','密码错误');
                }

            }else{

                $model->addError('username','用户名不存在');
            }
        }

        return $this->render('/site/login', ['model' => $model]);


//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
//
//        $model = new LoginForm();
//        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->goBack();
//        } else {
//            $model->password = '';
//
//            return $this->render('login', [
//                'model' => $model,
//            ]);
//        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }



}
