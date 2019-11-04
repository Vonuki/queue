<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('lg_common', 'About');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <span><?=Yii::t('lg_common', 'This is test service with allow you to generate simple queue and mange it.') ?> </span> <br>
        <span><?=Yii::t('lg_common', 'Clients have possibility to get in queue and have updates on items changes.') ?> </span>
    </p>
</div>
