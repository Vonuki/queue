<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Let's start queue..</h1>

        <p><a class="btn btn-lg btn-success" href="http://queue.easymatic.su/basic/web/index.php?r=user%2Fsecurity%2Flogin">Sign in</a></p>
        <p><a class="btn btn-lg btn-success" href="<?=Url::to(['queue/create-bu']) ?>">Create queue</a></p>
        <p><a class="btn btn-lg btn-success" href="http://queue.easymatic.su/basic/web/index.php?r=user%2Fsecurity%2Flogin">Get in queue</a></p>
    </div>

    <div class="body-content">

       ..in develope..

    </div>
</div>
