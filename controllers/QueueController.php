<?php

namespace app\controllers;

use Yii;
use app\models\Queue;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Owner;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
/**
 * QueueController implements the CRUD actions for Queue model.
 */
class QueueController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [ 
                      'allow' => true, 
                      'actions' => ['create','index', 'view', 'update', 'archive', ], 
                      'roles' => ['@']
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Queue models owned by user ( or all for Admins).
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->identity->isAdmin){
            $dataProvider = new ActiveDataProvider(['query' => Queue::find(),]);
            return $this->render('index', ['dataProvider' => $dataProvider,]);
        }
        else{
            $owner_temp = Owner::getUserOwner();   
            $dataProvider = new ActiveDataProvider([
              'query' => Queue::find()->where(['idOwner' => $owner_temp->idOwner]),       
            ]);
            return $this->render('index_bu', [
                'dataProvider' => $dataProvider,
            ]);
        }
    }
    
    /**
     * Displays a single Queue model if it owned by user or for Admin.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findAvailableModel($id);
        return $this->render('view', ['model' => $model,]);        
    }

    /**
     * Creates a new Queue model for person by user or Admin
     * hidden creation Owner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    { 
        $model = new Queue();
      
        if(Yii::$app->user->identity->isAdmin){}
        else{
          $owner = Owner::getUserOwner();
          $model->idOwner = $owner->idOwner;
          $model->FirstItem = 0; //first item number
          $model->QueueShare = 0; //private queue
          $model->QueueLen = 0; //curretn lentgh of queue
          $model->Status = 0; //status 
          $model->AvgMin = 0;//Average time in minutes
          $model->AutoTake = 1; // if new item will take aotomaticaly
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idQueue]);
        }
        
        if(Yii::$app->user->identity->isAdmin){
            return $this->render('create', [
              'model' => $model,
            ]);
        }
        else {
            return $this->render('create_bu', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Queue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findAvailableModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idQueue]);
        }

        if(Yii::$app->user->identity->isAdmin){
            return $this->render('update', ['model' => $model,]);   
        }
        else{
            return $this->render('update_bu', ['model' => $model,]); 
        }
    }
  
    /**
    * Set status for model Queue
    */
    public function StatusChange($id, $Status){
        $model = $this->findAvailableModel($id);
        $model->Status = $Status;
        if($model->save()){
          Yii::$app->session->setFlash('success', 'Queue Status changed');
        }
        else{
          Yii::$app->session->setFlash('error', 'Action not performed');
        }
        return $this->actionIndex();
    }
  
    public function actionArchive($id){
        return $this->StatusChange($id, 1);
    }
    
    public function actionPause($id){
        $this->StatusChange($id, 2);
    }
  

    /**
     * Deletes an existing Queue model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        
        $this->findAvailableModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Queue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Queue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Queue::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
  
    /**
    * Find Queue Model if user is owner or Admin
    */
    protected function findAvailableModel($id) {
        
        $model = $this->findModel($id);
        $owner_model = Owner::getUserOwner();
        if ($model->idOwner == $owner_model->idOwner or Yii::$app->user->identity->isAdmin){
            return $model;
        }
      
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
