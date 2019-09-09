<?php

/* @var $this yii\web\View 
Русская статическая страница...
*/

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page на русском. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>
