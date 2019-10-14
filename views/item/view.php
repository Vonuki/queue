<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Item */

$this->title = $model->idItem;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idItem], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idItem], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php 
      if(Yii::$app->user->identity->isAdmin){
          echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'idItem',
                'idQueue',
                'idClient',
                'Status',
                'CreateDate',
                'StatusDate',
                'RestTime',
                'Position',
                'Commment'
            ],
          ]);
      }
      else{
          echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'idItem',
                'idQueue',
                'idClient',
                'Status',
                'CreateDate',
                'StatusDate',
                'RestTime',
                'Position',
                'Comment'
            ],
          ]);
      }
     ?>

</div>
