<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Queue */

$this->title = 'Update Queue: ' . $model->idQueue;
$this->params['breadcrumbs'][] = ['label' => 'My Queues', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idQueue, 'url' => ['view_bu', 'id' => $model->idQueue]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="queue-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_bu', [
        'model' => $model,
    ]) ?>

</div>
