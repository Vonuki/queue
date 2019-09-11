<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker

/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idQueue')->textInput() ?>

    <?= $form->field($model, 'idClient')->textInput() ?>

    <?= $form->field($model, 'Status')->textInput() ?>
  
    <?= $form->field($model, 'CreateDate')->widget(DateTimePicker::classname(), [
          'options' => ['placeholder' => 'Enter event time ...'],
          'pluginOptions' => [
            'autoclose' => true,
            'todayHighlight' => true
          ]
        ]) 
    ?>
  
     <?= $form->field($model, 'StatusDate')->widget(DateTimePicker::classname(), [
          'options' => ['placeholder' => 'Enter event time ...'],
          'pluginOptions' => [
            'autoclose' => true,
            'todayHighlight' => true
          ]
        ]) 
    ?>

    <?= $form->field($model, 'RestTime')->textInput() ?>

    <?= $form->field($model, 'Position')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
