<?php

namespace app\controllers;

use Yii;
use app\models\Queue;
use app\models\VQueue;
use app\models\Item;
use app\models\VItem;
use app\models\Owner;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
            $dataProvider = new ActiveDataProvider(['query' => VQueue::find(),]);
        }
        else{
            $owner_temp = Owner::getUserOwner();   
            $dataProvider = new ActiveDataProvider([
              //'query' => Queue::find()->where(['idOwner' => $owner_temp->idOwner]),       
              'query' => $owner_temp->getQueues(),       
            ]);
        }
        return $this->render('index', ['dataProvider' => $dataProvider,]);
    }
    
    /**
     * Displays a single Queue model if it owned by user or for Admin.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $all = false, $finish = 0, $handle = 0)
    {
        $model = $this->findAvailableModel($id);
      
        //Finish item
        if($finish>0){
          Yii::$app->session->setFlash('success', 'ToDo finish and handle');
        }
        
        //Items for list
        if($all){
           $ItemsProvider = new ActiveDataProvider(['query' => $model->getItems(),]);
        }
        else {
           $ItemsProvider = new ActiveDataProvider(['query' => $model->getItems()->where(['Status' => [0,1] ]),]);
        }
        
        return $this->render('view', ['model' => $model,'ItemsProvider' => $ItemsProvider,]);        
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
          $model->fillOwner($owner);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idQueue]);
        }
        
        return $this->render('create', ['model' => $model,]);
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
            return $this->redirect(['index', 'id' => $model->idQueue]);
        }
        return $this->render('update', ['model' => $model,]);   
    }
  
    /**
    * Set status for model Queue - and direct actions
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
    public function actionActivate($id){
        $this->StatusChange($id, 0);
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
