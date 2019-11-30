<?php

namespace app\controllers;

use Yii;
use app\models\Item;
use app\models\VItem;
use app\models\Owner;
use app\models\Queue;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use yii\helpers\ArrayHelper;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
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
                      'actions' => ['create','index', 'cancel', 'update', 'view'], 
                      'roles' => ['@']
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin',]
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->identity->isAdmin){
            $dataProvider = new ActiveDataProvider(['query' => VItem::find(),'pagination' => ['pageSize' => 10,],]);
        }
        else{
            $owner = Owner::getUserOwner();   
            $dataProvider = new ActiveDataProvider(['query' => $owner->getItems(),'pagination' => ['pageSize' => 10,],]);
        }
      
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Item model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findAvailableModel($id);
        $queue_name = Queue::find()->where(['idQueue'=>$model->idQueue])->one()->Description;
        //echo "<br> <br> <br>". $model->ItemPrint();
        return $this->render('view', ['model' => $model,'queue'=>$queue_name]);
        
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Item();
        $queues = Queue::findPublic();
        $queuesMap = ArrayHelper::map($queues, 'idQueue', 'Description');
        
        $owner = Owner::getUserOwner();
        $model->FillEmptyItem($owner->idOwner);

        $request = Yii::$app->request;

        //Save on response
        if ($model->load($request->post()) ) {
          
            $queue = $model->getQueue()->One();
            $queue->addItemSave($model);
          
            return $this->redirect(['site/index']);
        }

        //Create item by token link
        $token = $request->get('Token');
    
        if (isset($token)) {
           $queueID = Queue::find()->where(['Token' => $token])->One();
		   $model->idQueue = $queueID->idQueue;
		   if($model->save()){
			    $queue = $model->getQueue()->One();
                $queue->addItemSave($model);
		   }
           return $this->redirect(['site/index']);
        }

        return $this->render('create', ['model' => $model, 'queues' => $queuesMap] );
    }

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findAvailableModel($id);
        $queues = Queue::findPublic();
        $queuesMap = ArrayHelper::map($queues, 'idQueue', 'Description');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           // $model->trigger(Item::EVENT_UPDATE_ITEM); 
            return $this->redirect(['index', 'id' => $model->idItem]);
        }

        return $this->render('update', ['model' => $model,'queues' => $queuesMap]);
    }

    /**
     * Deletes an existing Item model.
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
  
    public function actionCancel($id){
        $model = $this->findAvailableModel($id);
        if($model->CancelSave()){
          Yii::$app->session->setFlash('success', Yii::t('lg_common', 'Item Status changed'));
        }
        else{
          Yii::$app->session->setFlash('error', Yii::t('lg_common', 'Action not performed'));
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('lg_common', 'The requested page does not exist.'));
    }
  
    /**
    * Find Model if user is owner or Admin
    */
    protected function findAvailableModel($id) {
        
        $model = $this->findModel($id);
        $owner = Owner::getUserOwner();
        if ($model->idClient == $owner->idOwner or Yii::$app->user->identity->isAdmin){
            return $model;
        }
      
        throw new NotFoundHttpException(Yii::t('lg_common', 'The requested page does permited.'));
    }
}
