<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

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
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
      
     echo Nav::widget([
          'options' => ['class' => 'navbar-nav navbar-right'],
          'items' => [
              ['label' => 'Home', 'url' => ['/site/index']],
              ['label' => 'About', 'url' => ['/site/about']],
              ['label' => 'Contact', 'url' => ['/site/contact']],
          ],
      ]);
  
      if(Yii::$app->user->isGuest){
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Login', 'url' => ['/user/security/login']],
            ],
        ]);
      }
      else{
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'User Menu',
                  'options'=>['class'=>'dropdown'],
                  'items' => [
                    ['label' => 'Profile', 'url' => ['/user/settings/profile']],
                    '<li>'
                      . Html::beginForm(['/user/security/logout'], 'post')
                      . Html::submitButton('Logout (' . Yii::$app->user->identity->username . ')',['class' => 'btn btn-default logout'])
                      . Html::endForm()
                      . '</li>'
                    ]
                 ]
            ],
        ]);
      }
  
      if(isset(Yii::$app->user->identity) and Yii::$app->user->identity->isAdmin){
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Models', 
                  'options'=>['class'=>'dropdown'],
                  'items' => [
                    ['label' => 'Gii Code', 'url' => ['/gii']],
                    ['label' => 'Users', 'url' => ['/user/admin/index']],
                    ['label' => 'Queues', 'url' => ['services/valuation-services']],
                  ]
                ]
            ],
        ]);
      }
     
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
  
  <div>
    <?php echo '<br> <br>'.var_dump( $_SERVER['REMOTE_ADDR']);?>
  </div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; EasyQueue <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
