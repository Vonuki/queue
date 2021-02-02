<?php

use yii\bootstrap\Html;
use yii\helpers\Url;
use app\commands\Util;


if(\Yii::$app->language == 'ru'):
     echo Html::a(
                  '<i class="fas fa-language fa-fw"></i> <span class="badge badge-info badge-counter">En</span>',
                  str_replace('ru','en',Url::to()),
                  ['class' => "nav-link dropdown-toggle"]
                );
else:
    echo Html::a(
                  '<i class="fas fa-language fa-fw"></i> <span class="badge badge-info badge-counter">Ru</span>',
                  str_replace('en','ru',Url::to()), 
                  ['class' => "nav-link dropdown-toggle"]
                );
endif;


?>