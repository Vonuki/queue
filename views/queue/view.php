<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Queue */

$this->title = $model->idQueue;
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
            'FirstItem',
            'QueueLen',
            ['attribute' => 'Status', 'format' => 'raw', 'value' => $model->getStatusTxt(), ],
            'AvgMin',
            'AutoTake',
        ],
    ]) ?>
  
     <h3><?= Html::encode(Yii::t('lg_common', 'Items in queue')) ?></h3>
  
    <?= GridView::widget([
        'dataProvider' => $ItemsProvider,
        'columns' => [
            'idItem',
            'OwnerDescription', //'idClient',
            ['class' => 'yii\grid\ActionColumn',]
        ],
    ]); ?>

  
    

</div>
