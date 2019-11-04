<?php

/* @var $this yii\web\View 
Русская статическая страница...
*/

use yii\helpers\Html;

$this->title = Yii::t('lg_common', 'About');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Это тестовый сервис, который позволяет создать простую очередь и управлять ей. <br>
        Клиенты имеют возможность встать в очередь и получать обновления об изменениях очереди.
    </p>
</div>
