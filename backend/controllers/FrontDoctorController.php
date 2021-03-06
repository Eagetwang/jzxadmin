<?php

namespace backend\controllers;

use app\models\UploadForm;
use Yii;
use yii\data\Pagination;
use backend\models\FrontDoctor;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * FrontDoctorController implements the CRUD actions for FrontDoctor model.
 */
class FrontDoctorController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all FrontDoctor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = FrontDoctor::find();
         $querys = Yii::$app->request->get('query');
        if(count($querys) > 0){
            $condition = "";
            $parame = array();
            foreach($querys as $key=>$value){
                $value = trim($value);
                if(empty($value) == false){
                    $parame[":{$key}"]=$value;
                    if(empty($condition) == true){
                        $condition = " {$key}=:{$key} ";
                    }
                    else{
                        $condition = $condition . " AND {$key}=:{$key} ";
                    }
                }
            }
            if(count($parame) > 0){
                $query = $query->where($condition, $parame);
            }
        }

        $pagination = new Pagination([
            'totalCount' =>$query->count(), 
            'pageSize' => '10', 
            'pageParam'=>'page', 
            'pageSizeParam'=>'per-page']
        );
        
        $orderby = Yii::$app->request->get('orderby', '');
        if(empty($orderby) == false){
            $query = $query->orderBy($orderby);
        }
        
        
        $models = $query
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
        ]);
    }

    /**
     * Displays a single FrontDoctor model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());

    }

    /**
     * Creates a new FrontDoctor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $doctor = "";
        if($id = Yii::$app->request->get('id')){
            $model = new FrontDoctor();
            $doctor = $model->getById($id);
        }
        return $this->render('create',[
            'doctor'=>$doctor,
        ]);
    }

    public function actionAddDoctor(){
        $img_url = "";
        $upload = new UploadForm();

        $upload->imageFile = UploadedFile::getInstance($upload,'imageFile');
        if ($upload->imageFile && $upload->validate()) {
            $img_url = $upload->upload();
        }else{
            $msg = array('errno'=>2, 'msg'=>'图片格式错误');
            echo json_encode($msg);
        }
        $model = new FrontDoctor();
//        var_dump(Yii::$app->request->post());exit;
        if ($model->load(Yii::$app->request->post())) {
            $model->img = $img_url;
            $model->create_time = time();
            $model->update_time = time();
            if($model->validate() == true && $model->save()){
                $msg = array('errno'=>0, 'msg'=>'保存成功','pid'=>$model->id,'sign'=>md5($model->id));
                echo json_encode($msg);
            }
            else{
                $msg = array('errno'=>2, 'data'=>$model->getErrors());
                echo json_encode($msg);
            }
        } else {
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            echo json_encode($msg);
        }
    }

    /**
     * Updates an existing FrontDoctor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $img_url = "";
        $upload = new UploadForm();

        $upload->imageFile = UploadedFile::getInstance($upload,'imageFile');
        if ($upload->imageFile && $upload->validate()) {
            $img_url = $upload->upload();
        }

        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {

            if($img_url){
                $model->img = $img_url;
            }
        
            if($model->validate() == true && $model->save()){
                $msg = array('errno'=>0, 'msg'=>'保存成功');
                echo json_encode($msg);
            }
            else{
                $msg = array('errno'=>2, 'data'=>$model->getErrors());
                echo json_encode($msg);
            }
        } else {
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            echo json_encode($msg);
        }
    
    }

    /**
     * Deletes an existing FrontDoctor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = FrontDoctor::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    
  
    }

    /**
     * Finds the FrontDoctor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return FrontDoctor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FrontDoctor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
