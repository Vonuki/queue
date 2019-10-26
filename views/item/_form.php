<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
      if(Yii::$app->controller->action->id != "update"){ 
        echo $form->field($model, 'idQueue')->widget(Select2::classname(), [
          'data' => $queues,
          'options' => ['placeholder' => Yii::t('lg_common', 'Select a Queue ...')],
          'pluginOptions' => [
              'allowClear' => true
          ],
         ]);
      }
      echo $form->field($model, 'Comment')->textArea();
    ?>
  
    <?php 
      if(Yii::$app->user->identity->isAdmin){
          echo $form->field($model, 'idClient')->textInput();
          echo $form->field($model, 'Status')->textInput();
          echo $form->field($model, 'CreateDate')->widget(DateTimePicker::classname(), [
              'options' => ['placeholder' => 'Enter event time ...'],
              'pluginOptions' => [ 'autoclose' => true,'todayHighlight' => true]
            ]);
          echo $form->field($model, 'StatusDate')->widget(DateTimePicker::classname(), [
              'options' => ['placeholder' => 'Enter event time ...'],
              'pluginOptions' => ['autoclose' => true, 'todayHighlight' => true ]
            ]);
          echo $form->field($model, 'RestTime')->textInput();
          echo $form->field($model, 'Position')->textInput();      
      }  
    ?>
  
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
