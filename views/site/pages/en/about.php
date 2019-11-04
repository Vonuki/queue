<?php

/* @var $this yii\web\View 
EN static page...
*/

use yii\helpers\Html;

$this->title = Yii::t('lg_common', 'About');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is test service with allow you to generate simple queue and mange it. <br>
        Clients have possibility to get in queue and have updates on items changes.
    </p>
</div>
