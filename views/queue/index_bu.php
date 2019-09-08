<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Queues';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="queue-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Queue', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
 
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'Description',
            'Status',
            ['class' => 'yii\grid\ActionColumn',
             'template' => '{view} {update} {archive}',
             'buttons' => [
                'archive' => function ($url,$model,$key) {
                    return Html::a('Archive', $url);
                },
            ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
