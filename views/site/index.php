<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
/* @var $this yii\web\View */

$this->title = 'EasyQueue';
?>
<?php
$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refreshButton").click(); }, 3000);
});
JS;
$this->registerJs($script);
?>
<div class="site-index">
   

    <div class="jumbotron">
           

      <h4><?=Yii::t('lg_common', 'Let`s start queue..')?> </h4>
      <p><a class="btn btn-lg btn-success" style="width:250px" href="<?=Url::to(['queue/create']) ?>"> <?=Yii::t('lg_common', 'Create Queue') ?></a></p>
      <p><a class="btn btn-lg btn-success" style="width:250px" href="<?=Url::to(['item/create']) ?>"> <?=Yii::t('lg_common', 'Get in queue')?> </a></p>
    
        <?php 
            Pjax::begin();?>
            <?= Html::a("Обновить", ['site/index'], ['class' => 'hidden', 'id' => 'refreshButton']) ?>
            <?php foreach ($user_queues as $queue): 
                $position = $queue['item']->Position;
            ?>
           
            <hr class="m-y-10">
                <?=Yii::t('lg_common', 'Your position in queue')?>
                    <b><?= $queue['queue_name']?></b>:
                    <p class="lead">
                    <?php if ($position < 3) : ?>
                        <h1 class="btn btn-warning"><?= $position?></h1>
                    <?php else : ?>
                        <h1 class="btn btn-info"><?= $position?></h1>  
                    <?php endif ?> 
                    </p>
                
            </span>
       
            <?php endforeach;
            Pjax::end(); 
            ?>
    </div>

    <div class="body-content">

      

    </div>
</div>
