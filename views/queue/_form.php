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
      echo $form->field($model, 'QueueShare')->dropDownList($model->getShareLabels());
      echo $form->field($model, 'Status')->dropDownList($model->getStatusTexts());
      
      if(Yii::$app->user->identity->isAdmin){
        echo $form->field($model, 'idOwner')->textInput();
        echo $form->field($model, 'FirstItem')->textInput();
        echo $form->field($model, 'QueueLen')->textInput();
        echo $form->field($model, 'Takt')->textInput();      
        echo $form->field($model, 'Cycle')->textInput();     
        echo $form->field($model, 'Finished')->textInput();     
        
      } 
  
      echo $form->field($model, 'AutoTake')->dropDownList($model->getAutoTakeTexts());
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
