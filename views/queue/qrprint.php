<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

// >> QR code
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;
// << QR code

/* @var $this yii\web\View */
/* @var $model app\models\Queue */

$this->title = $model->Description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('lg_common', 'Queues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

// >> QR code Token for access to hidden queue 
$TokenUrl = Url::to("@web/item/create?Token=$model->Token",true);
$qrCode = new QrCode($TokenUrl);
$qrCode->setSize(150);
$qrCode->setWriterByName('svg');
// << QR code

?>
<div class="queue-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idQueue',
            'Description',
            ['attribute' => 'QueueShare', 'format' => 'raw', 'value' => $model->getQueueShareTxt(), ],
            //'idOwner',
            'OwnerDescription',
            //'FirstItem',
            ['attribute' => 'Status', 'format' => 'raw', 
             'value' => function ($model, $column) {
                          return \yii\helpers\Html::tag('span',$model->getStatusText(),['class' => $model->getStatusLabel()] );
                        },
            ],
            // Token for access to hidden queue
            ['attribute' => 'Token', 'format' => 'raw',
            'value' =>
            Html::a($qrCode->writeString(),$TokenUrl) // QR
            , ],
          ],
    ]) ?>
</div>
