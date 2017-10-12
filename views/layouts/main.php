<?php

/* @var $this \yii\web\View */
/* @var $content string */

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
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <ul id="menu">
        <li id="botonNav" > <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span> Taurus Gym Platinum </li>
        <?php
            $extraMenu= false;
            if (\Yii::$app->user->can('administrador')) {
                $extraMenu = true;
                echo Html::a("Administrar",['administrar/index']);
            }

            if (\Yii::$app->user->can('empleado')) {
                echo Html::a("Ventas",['administrar/index']);
                echo Html::a("Caja",['administrar/index']);
                $extraMenu = true;
            }
            if(!$extraMenu){
                echo Html::a("Principal",['site/login']);
                echo Html::a("Nosotros",['site/login']);
            }
            
        ?>
        <li class="logodiv"><?= Html::img("@web/images/logo.jpg", ["class"=> "img-circle logo"]) ?></li>
        <?php 

            if (\Yii::$app->user->can('empleado')) {
                echo Html::a("Membrecias",['administrar/index']);
                $extraMenu = true;
            }
            if(!$extraMenu){
                echo Html::a("Promociones",['site/login']);
            }
        ?>
        <?php
            if(Yii::$app->user->isGuest){
                echo Html::a("Entrar",['site/login']);
            }else{
                echo Html::a("Mi Cuenta",['site/login']);
                echo Html::a("Salir (".Yii::$app->user->identity->username.")",['site/logout'],[
                    'data-confirm' => "¿Realmente deseas salir del sistema?",
                    'data-method' => 'post',
                    //'data-params' => 'myParam=anyValue'
                ]);
            }
        ?>
    </ul>

    <div class="container">
        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; TAURUS GYM PLATINUM  <?= date('Y') ?></p>
    </div>
</footer>

<?php
    $this->registerJs(
        "
            var contador = 1;
            $('#botonNav').click(function(){
                if(contador == 1){
                    contador = 0;
                    $('#menu').css('height', 'auto');
                } else {
                    contador = 1;
                    $('#menu').css('height', '72px');
                }
         
            });
        "
    );
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
