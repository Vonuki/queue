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
                $id = $queue['item']->idItem;
                $css_class ='btn btn-info';
            ?>
           
            <!-- <hr class="m-y-10"> -->
            <div class="panel panel-info" style="width:250px; margin:auto"  >
                <div class="panel-heading">
                    <?=Yii::t('lg_common', 'Your position in queue')?><br>
                    <b><?= $queue['queue_name']?></b>:
                </div>
                    <div class="panel-body">
                        <?php 
                            if ($position < 3) :
                            $css_class ='btn btn-warning'; 
                            endif 
                        ?> 
                        <a class="<?=$css_class?>" href="<?=Url::to(['item/update','id' => $id])?>"><?="<b>$position</b>"?></a>    
                    </div>
                    <div class="panel-footer">
                        <?php if ($queue['item']->Comment != ''):?>
                            <?=Yii::t('lg_common', 'Comment')?>: <?=$queue['item']->Comment?><br>
                        <?php endif ?>
                        <?=Yii::t('lg_common', 'Estimate Rest Time')?>:<br> 
                        <?=date("d \d\a\y\s H:i",$queue['item']->RestTime)?>
                    </div>
            </div>
            <br>
            <?php endforeach;
            Pjax::end(); 
            ?>
    </div>

    <div class="body-content">

      

    </div>
</div>
