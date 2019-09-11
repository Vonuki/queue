<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Owners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="owner-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php if(Yii::$app->user->identity->isAdmin){ ?>
      <p>
          <?= Html::a('Create Owner', ['create'], ['class' => 'btn btn-success']) ?>
      </p>
    <?php }?>

    <?php Pjax::begin(); ?>
  
     <?php 
          if (Yii::$app->user->identity->isAdmin) {
              $actions_string = '{view} {update} {delete}'; 
          }
          else{ 
              $actions_string = '{view} {update}'; 
          }
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [            
            'idOwner',
            'Description',
            'idPerson',
            'Status',
            
            ['class' => 'yii\grid\ActionColumn',
              'template' => $actions_string,
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
