<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Owner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="owner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Description')->textInput(['maxlength' => true]) ?>

     <?php
      if(Yii::$app->user->identity->isAdmin){
        echo $form->field($model, 'idPerson')->textInput();
      }
      else {
        echo $form->field($model, 'idPerson')->hiddenInput()->label(false);
      }
    ?>

    <?= $form->field($model, 'Status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
