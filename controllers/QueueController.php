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
                      'actions' => ['create','index', 'view', 'update', 'archive','activate', 'pause' ], 
                      'roles' => ['genuser'] //or using: '@' - for all users
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
              'query' => $owner_temp->getQueues(),  
              // or like this //'query' => Queue::find()->where(['idOwner' => $owner_temp->idOwner]),       
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
    public function actionView($id, $all = false)
    {
        $model = $this->findModel($id);
        if(Yii::$app->user->can('manageQueue', ['queue' => $model])){
          //Finish item
          $finish = Yii::$app->request->post('finish', null);
          if(isset($finish)){
            try{
              $model->FinishItemSave($finish);  
              Yii::$app->session->setFlash('success', Yii::t('lg_common', 'Item finished'));             
            }
            catch(\ErrorException $e) {
              Yii::$app->session->setFlash('error', 'Finish Error: '.$e->getMessage());  
            } catch(\Throwable $e) {
                throw $e;
            }
            return $this->redirect(['view', 'id' => $model->idQueue]);
          }

          //Handle item
          $handle = Yii::$app->request->post('handle', null);
          if(isset($handle)){
            try{
              $model->HandleItemSave($handle);  
              Yii::$app->session->setFlash('success', Yii::t('lg_common', 'Item is being handled '));              
            }
            catch(\ErrorException $e) {
              Yii::$app->session->setFlash('error', 'Handled Error: '.$e->getMessage());  
            } catch(\Throwable $e) {
                throw $e;
            } 
            return $this->redirect(['view', 'id' => $model->idQueue]);
          }  
        }
        else{
           throw new NotFoundHttpException( Yii::t('lg_common', 'No permissions for operation') );
        }
        
        //Items for list
        if($all){
           $ItemsProvider = new ActiveDataProvider(['query' => $model->getVItems(),'pagination' => ['pageSize' => 4,],]);
        }
        else {
           $ItemsProvider = new ActiveDataProvider(['query' => $model->getVItems()->where(['Status' => [0,1] ]),'pagination' => ['pageSize' => 4,],]);
        }
        $model = $this->findVModel($id);
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
        $model->initQueue();

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
        $model = $this->findModel($id);
        if(Yii::$app->user->can('manageQueue', ['queue' => $model])){
          if ($model->load(Yii::$app->request->post()) && $model->save()) {
              return $this->redirect(['index']);
          }
        }
        else{
           throw new NotFoundHttpException( Yii::t('lg_common', 'No permissions for operation') );
        }
        return $this->render('update', ['model' => $model,]);   
    }
  
    /**
    * Set status for model Queue - and direct actions
    */
    public function StatusChange($id, $Status){
      
        $model = $this->findModel($id);
        if(Yii::$app->user->can('manageQueue', ['queue' => $model])){
          $model->Status = $Status;
          if($model->save()){
            Yii::$app->session->setFlash('success', Yii::t('lg_common', 'Queue Status changed'));
          }
          else{
            Yii::$app->session->setFlash('error', Yii::t('lg_common', 'Action not performed'));
          } 
        }
        else{
           throw new NotFoundHttpException( Yii::t('lg_common', 'No permissions for operation') );
        }       
        return $this->redirect(['view', 'id' => $id]);
    }
    public function actionArchive($id){
        return $this->StatusChange($id, 1);
    }
    public function actionPause($id){
        return $this->StatusChange($id, 2);
    }
    public function actionActivate($id){
        return $this->StatusChange($id, 0);
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
        $model = $this->findModel($id);
        if(Yii::$app->user->can('grantQueue', ['queue' => $model])){
          $model->delete();
        }
        else{
          throw new NotFoundHttpException( Yii::t('lg_common', 'Operation was interupted') );
        }
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

        throw new NotFoundHttpException(Yii::t('lg_common', 'The rquested model does not exist'));
    }
  
    /**
     * Finds the Queue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Queue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findVModel($id)
    {
        if (($model = VQueue::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('lg_common', 'The rquested model does not exist'));
    }
  
}
