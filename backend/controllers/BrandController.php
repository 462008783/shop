<?php

namespace backend\controllers;

use backend\models\brand;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\UploadedFile;
use crazyfd\qiniu\Qiniu;

class BrandController extends \yii\web\Controller
{

    /**列表显示
     * @return string
     */
    public function actionIndex()
    {
        // 得到数据
        $models = Brand::find();

        //总的条数
        $count =$models->count();

        //分页对象
        $page =new Pagination([
           'pageSize' => 2,//每页显示条数
            'totalCount' => $count,
        ]);

        //查询分页后的数据
        $model=$models->offset($page->offset)->limit($page->limit)->all();

        //显示视图  分配数据
        return $this->render('index',compact('model',['page']));
    }


    /**品牌添加
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        //创建模型对象
        $model = new Brand();

        //判断是否post
        if (\Yii::$app->request->isPost) {

            //绑定数据
            $model->load(\Yii::$app->request->post());

            //得到文件上传对象
//            $model->logImg=UploadedFile::getInstance($model,'logImg');

            //定义空的
//            $imgPath="";
//            //判断是否为空
//            if ($model->logImg!==null) {
//
//                //生成图片地址
////                $imgPath='images/'.time().'.'.$model->logImg->extension;
//
//                //移动临时文件到目录
//                $model->logImg->saveAs($imgPath,false);
//            }

            //后台验证
            if ($model->validate(false)) {

                //保存数据
//                $model->logo=$imgPath;
                if ($model->save()) {

                    //提示信息
                    \Yii::$app->session->setFlash('success','添加成功');

                    //返回列表
                    return $this->redirect('index');
                }
            }else{

                //打印错误信息
                var_dump($model->errors);exit;
            }
        }


        //视图引入
        return $this->render('add',compact('model'));

    }


    /**品牌编辑
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
       //找到编辑的对象
        $model= Brand::findOne($id);

        //判断是否post
        if (\Yii::$app->request->isPost) {
            //绑定数据
            $model->load(\Yii::$app->request->post());

            //得到文件上传对象
            $model->logImg=UploadedFile::getInstance($model,'logImg');

            //定义空的
            $imgPath="";
            //判断是否为空
            if ($model->logImg!==null) {

                //生成图片地址
                $imgPath='images/'.time().'.'.$model->logImg->extension;

                //移动临时文件到目录
                $model->logImg->saveAs($imgPath,false);
            }

            //后台验证
            if ($model->validate(false)) {

                //保存数据
                $model->logo=$imgPath?:$model->logo;//是否传来图片

                if ($model->save()) {

                    //提示信息
                    \Yii::$app->session->setFlash('success','编辑成功');

                    //返回列表
                    return $this->redirect('index');
                }
            }else{

                //打印错误信息
                var_dump($model->errors);exit;
            }
        }


        //视图引入
      return $this->render('add',compact('model'));
    }


    /**品牌删除
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDel($id)
    {

        //找到删除对象
        $brand=Brand::findOne($id)->delete();

        if ($brand){
            //提示信息
            \Yii::$app->session->setFlash('success','删除成功');

            //返回列表
            return $this->redirect('index');
        }
    }


    /**品牌状态
     * @param $id
     * @return \yii\web\Response
     */
    public function actionLine($id)
    {
        //找到编辑对象
        $line = Brand::findOne($id);

        $line->status=$line->status==1?0:1;

        //保存
        if ($line->save()) {
            //提示信息
            \Yii::$app->session->setFlash('success','状态修改成功');

            //返回列表
            return $this->redirect('index');
        }
    }


    /**品牌图片完善
     * @return string
     */
    public function actionUpload()
    {
        switch (\Yii::$app->params['uploadType']){

            case 'localhost':
                //得到文件上传对象
                $file=UploadedFile::getInstanceByName('file');

                //判断文件是否得到
                if ($file!==null) {

                    //文件上传地址
                    $filePath ='images/'.time().'.'.$file->extension;

                    //移动临时文件到目录
                    if ($file->saveAs($filePath,false)) {

                        // 正确时， 其中 attachment 指的是保存在数据库中的路径，url 是该图片在web可访问的地址
                        //{"code": 0, "url": "http://domain/图片地址", "attachment": "图片地址"}
                        $result= [
                          'code'=>0,
                          'url' =>'/'.$filePath,
                          'attachment'=>$filePath,
                        ];

                        //返回
                        return json_encode($result);

                    }
                }else{
                    //TODO
                    // 错误时
                    //{"code": 1, "msg": "error"}
                    $result=[
                      'code'=>1,
                      'msg' =>'error',
                    ];
                    return json_encode($result);
                }

            case 'qiniu':

                $ak = 'nr3jPCjd5NfssMnMver1-whjDZEoPSLde7R3DLb_';//应用ID
                $sk = 'lCEez1FZhAFGBDkNhiRspyeiyX2sG3GtrQv3nPD_';//密钥
                $domain = 'http://p5oeelfuq.bkt.clouddn.com/';//地址
                $bucket = 'shop-1108';//空间名
                $zone = 'south_china';//区块

                //七牛云的创建
                $qiniu = new Qiniu($ak, $sk,$domain, $bucket,$zone);
                $key = uniqid();
                //路径的拼接
                $key .= strtolower(strrchr($_FILES['file']['name'], '.'));

                //七牛云上传
                $qiniu->uploadFile($_FILES['file']['tmp_name'],$key);
                $url = $qiniu->getLink($key);

                $result= [
                    'code'=>0,
                    'url' =>$url,
                    'attachment'=>$url,
                ];
                //返回数据
                return json_encode($result);


        }

    }


}
