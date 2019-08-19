<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Queue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="queue-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QueueShare')->textInput() ?>

    <?= $form->field($model, 'idOwner')->textInput() ?>

    <?= $form->field($model, 'FirstItem')->textInput() ?>

    <?= $form->field($model, 'QueueLen')->textInput() ?>

    <?= $form->field($model, 'Status')->textInput() ?>
  
    <?= $form->field($model, 'AvgMin')->textInput() ?>
  
    <?= $form->field($model, 'AutoTake')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
