<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Queue */

$this->title = $model->Description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lg_common', 'Queues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="queue-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a(Yii::t('lg_common', 'Update'), ['update', 'id' => $model->idQueue], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('lg_common', 'Archive'), ['archive', 'id' => $model->idQueue], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to archive this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('lg_common', 'Pause'), ['pause', 'id' => $model->idQueue], [
            'class' => 'btn btn-danger',
            'data' => [ 'method' => 'post',],
        ]) ?>
        <?= Html::a(Yii::t('lg_common', 'Activate'), ['activate', 'id' => $model->idQueue], [
            'class' => 'btn btn-danger',
            'data' => [ 'method' => 'post',],
        ]) ?>
        <?php 
          if(Yii::$app->user->identity->isAdmin){
            echo Html::a(Yii::t('lg_common', 'Delete'), ['delete', 'id' => $model->idQueue], [
                'class' => 'btn btn-danger',
                'data' => [
                  'confirm' => 'Are you sure you want to delete this item?',
                  'method' => 'post',
                ],
            ]);
          }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idQueue',
            'Description',
            ['attribute' => 'QueueShare', 'format' => 'raw', 'value' => $model->getQueueShareTxt(), ],
            'idOwner',
            //'OwnerDescription',
            //'FirstItem',
            'QueueLen',
            ['attribute' => 'Status', 'format' => 'raw', 'value' => $model->getStatusText(), ],
            ['attribute' => 'Takt', 'value' => date("H:i:s",$model->Takt), ],
            'AutoTake',
            ['attribute' => 'Cycle', 'value' => date("H:i:s",$model->Cycle), ],
            'Finished',
        ],
    ]) ?>
  
    <h3><?= Html::encode(Yii::t('lg_common', 'Items in queue')) ?></h3>
    
    <?php Pjax::begin(); ?>
  
    <?=  Html::a(Yii::t('lg_common', 'All Items'), ['view', 'id' => $model->idQueue, 'all' => true], [
                'class' => 'btn btn-info',
            ]) ?>
    <?=  Html::a(Yii::t('lg_common', 'Active Items'), ['view', 'id' => $model->idQueue,], [
                'class' => 'btn btn-info',
            ]) ?>
  
    <?= GridView::widget([
        'dataProvider' => $ItemsProvider,
        'filterModel' => new \app\models\Item(),
        'columns' => [
            'idItem',
            'OwnerDescription', //'idClient',
            'Position',        
            'CreateDate',
            'StatusDate',
            ['attribute' => 'RestTime', 'value' => function ($model, $key, $index, $column) { return date("H:i:s",$model->RestTime);}, ],
            [ 'attribute' => 'Status', 'format' => 'raw',
              'filter' => [
                    0 => 'No',
                    1 => 'Yes',
                ],
             'value' => 
                function ($model, $key, $index, $column) { 
                  return \yii\helpers\Html::tag('span',$model->getStatusText(),['class' => $model->getStatusLabel()] );
                }, 
            ],
            ['class' => 'yii\grid\ActionColumn',
              'template' => '{handle} {finish}',
              'buttons' => [
                'handle' => function ($url, $model,$key) {
                    if($model->Status == 0){ return Html::a(Yii::t('lg_common', 'Handle'), Url::to(['queue/view', 'id' => $model->idQueue, 'handle' => $key]), ['data-pjax' => '0']  ); }
                    else { return '';}
                },
                'finish' => function ($url, $model,$key) {
                   if($model->Status == 1){ return Html::a(Yii::t('lg_common', 'Finish'), Url::to(['queue/view', 'id' => $model->idQueue, 'finish' => $key]), ['data-pjax' => '0'] );}
                   else {return ''; }
                },
              ]
            ],
        ],
    ]); ?>
  
    <?php Pjax::end(); ?>

  
    

</div>
