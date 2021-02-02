<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

use app\models\Owner;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody();?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/img/Logo 2.png', ['alt' => 'pic not found','height' =>'40']), 
        // color #A7C520
        //'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => ['style' => 'padding-top:7px',],
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
  
     
     echo Nav::widget([
          'options' => ['class' => 'navbar-nav navbar-right'],
          'items' => [
              ['label' => '<span class="glyphicon glyphicon-info-sign">  </span>    '.Yii::t('lg_common', 'About'),
                  'options'=>['class'=>'dropdown'],
                  'items' => [
                    //['label' => Yii::t('lg_common', 'Home'), 'url' => ['/site/index']],
                    ['label' => Yii::t('lg_common', 'About'), 'url' => ['/page/about']],
                    ['label' => Yii::t('lg_common', 'Contact'), 'url' => ['/site/contact']],
                   ],
              ],
          ],
          'encodeLabels' => false,
      ]);
  
      if(Yii::$app->user->isGuest){
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => '<span class="glyphicon glyphicon-log-in">  </span>   '. Yii::t('lg_common', 'Login'), 'url' => ['/user/security/login'], ],
                ['label' => '<span class="glyphicon glyphicon-user">  </span>   '. Yii::t('lg_common', 'Sign up'), 'url' => ['/user/register'], ],
            ],
            'encodeLabels' => false,
        ]);
      }
      else{
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'encodeLabels' => false,
            'items' => [
                ['label' => '<span class="glyphicon glyphicon-user">  </span>   '.Yii::t('lg_common', 'User Menu'),
                  'options'=>['class'=>'dropdown'],
                  'items' => [
                    ['label' => Yii::t('lg_common', 'Profile'), 'url' => ['/user/settings/profile']],
                    '<li>'
                      . Html::beginForm(['/user/security/logout'], 'post')
                      . Html::submitButton(Yii::t('lg_common', 'Logout').':'. Yii::$app->user->identity->username,['class' => 'btn btn-default logout'])
                      . Html::endForm()
                      . '</li>'
                    ]
                 ]
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'encodeLabels' => false,
            'items' => [
                ['label' => '<span class="glyphicon glyphicon-tasks">  </span>   '. Yii::t('lg_common', 'Manage'), 
                  'options'=>['class'=>'dropdown'],
                  'items' => [
                    ['label' => Yii::t('lg_common', 'Owner info'), 'url' => ['/owner/index']],
                    ['label' => Yii::t('lg_common', 'Queues'), 'url' => ['/queue/index']],
                    ['label' => Yii::t('lg_common', 'Items'), 'url' => ['/item/index']],
                  ]
                ]
            ],
        ]);
      }
  
      if(isset(Yii::$app->user->identity) and Yii::$app->user->identity->isAdmin){
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Administration', 
                  'options'=>['class'=>'dropdown'],
                  'items' => [
                    ['label' => 'Gii Code', 'url' => ['/gii']],
                    ['label' => 'Users', 'url' => ['/user/admin/index']],
                  ]
                ]
            ],
        ]);
      }
  
      ?>
          <ul class="navbar-nav navbar-right nav"> <li>
            <?= $this->render('select-language') ?>
          </li> </ul>
      <?php
     
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

</div>
  
<footer class="footer">
    <div class="container">
        <p class="pull-left" style="font-size:12px">
            &copy; EasyQueue <?= date('Y') ?> 
        </p>
<!--         <?=Html::img('@web/img/long_queue.png', ['alt' => 'pic not found','height' =>'40']) ?> -->
        <p class="pull-right" style="font-size:10px">
            <?= Yii::powered() ?> <br>
            Icon made by <a href="https://www.freepik.com/home">Freepik</a> from <a href="http://www.flaticon.com/">www.flaticon.com</a>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
