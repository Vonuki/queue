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
                      'actions' => ['create-bu','index-bu', 'view-bu', 'update-bu'], 
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
        $dataProvider = new ActiveDataProvider([
          'query' => Queue::find(),       
        ]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
  
    /**
     * Lists all Queue models owned by user.
     * @return mixed
     */
    public function actionIndexBu()
    {   
        $owner_temp = Owner::findByUser(Yii::$app->user->identity->id);   
        $dataProvider = new ActiveDataProvider([
          'query' => Queue::find()->where(['idOwner' => $owner_temp->idOwner]),       
        ]);
      
        return $this->render('index_bu', [
            'dataProvider' => $dataProvider,
        ]);
    }
  
    /**
     * Displays a single Queue model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
  
    /**
     * Displays a single Queue model if it owned by user.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewBu($id)
    {
        $owner_temp = Owner::findByUser(Yii::$app->user->identity->id);   
        $queue_model = $this->findModel($id);
        if ($queue_model->idOwner == $owner_temp->idOwner){
          return $this->render('view_bu', [
            'model' => $queue_model,
          ]);  
        }
        else{
          throw new NotFoundHttpException('The requested page does not exist.');
        }
        
    }

    /**
     * Creates a new Queue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Queue();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idQueue]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
  
    /**
     * Creates a new Queue model for person by user
     * hidden creation Owner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateBu()
    { 
        $current_user = Yii::$app->user->identity->id;
        $owner = Owner::findOne(['idPerson' => $current_user, 'Status' => 0]);
        if (is_null($owner)) {
          $owner = new Owner();
          $owner -> idPerson = $current_user;
          $owner -> Description = "my_queue".Yii::$app->user->identity->id;
          $owner -> save();
        }
      
        $model = new Queue();
        $model->idOwner = $owner->idOwner;
        $model->FirstItem = 0; //first item number
        $model->QueueShare = 0; //private queue
        $model->QueueLen = 0; //curretn lentgh of queue
        $model->Status = 0; //status 

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idQueue]);
        }

        return $this->render('create_bu', [
            'model' => $model,
        ]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idQueue]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
        $this->findModel($id)->delete();

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
}
