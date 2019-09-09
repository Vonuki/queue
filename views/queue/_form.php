<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Queue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="queue-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
      echo $form->field($model, 'Description')->textInput(['maxlength' => true]);
      echo $form->field($model, 'QueueShare')->dropDownList($model->QueueShareLabels);
      echo $form->field($model, 'Status')->dropDownList($model->StatusLabels);
      
      if(Yii::$app->user->identity->isAdmin){
        echo $form->field($model, 'idOwner')->textInput();
        echo $form->field($model, 'FirstItem')->textInput();
        echo $form->field($model, 'QueueLen')->textInput();
        echo $form->field($model, 'AvgMin')->textInput();      
      } 
      else{
        echo $form->field($model, 'idOwner')->hiddenInput()->label(false);
        echo $form->field($model, 'FirstItem')->hiddenInput()->label(false);
        echo $form->field($model, 'QueueLen')->hiddenInput()->label(false);
        echo $form->field($model, 'AvgMin')->hiddenInput()->label(false);
      }
  
      echo $form->field($model, 'AutoTake')->textInput();
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
