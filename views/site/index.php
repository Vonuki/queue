<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
      <h4><?=Yii::t('lg_common', 'Let`s start queue..')?> </h4>
      <p><a class="btn btn-lg btn-success" href="<?=Url::to(['queue/create']) ?>"> <?=Yii::t('lg_common', 'Create Queue') ?></a></p>
      <p><a class="btn btn-lg btn-success" href="<?=Url::to(['item/create']) ?>"> <?=Yii::t('lg_common', 'Get in queue')?> </a></p>
    </div>

    <div class="body-content">

      

    </div>
</div>
