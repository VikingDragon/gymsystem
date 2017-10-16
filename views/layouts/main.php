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
                echo Html::a("Ventas",['venta/venta']);
                echo Html::a("Compras",['compra/compra']);
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
                echo Html::a("Membrecias",['membrecia/index']);
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
yii\bootstrap\Modal::begin([
    'header' => '<span id="modalHeaderTitle"></span>',
    'id' => 'modal',
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
echo "<div id='modalContent' class='text-center'><div style='text-align:center'><img src='".Yii::getAlias('@web')."/images/load.gif'></div></div>";
echo '<div id="modal-footer"></div>';
yii\bootstrap\Modal::end();
?>

<?php
yii\bootstrap\Modal::begin([
    'header' => '<span id="modalHeaderTitle2"></span>',
    'id' => 'modal2',
    //'size' => 'modal-sm',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => TRUE]
]);
echo "<div id='modalContent2' class='text-center'><div style='text-align:center'><img src='".Yii::getAlias('@web')."/images/load.gif'></div></div>";
echo '<div id="modal-footer2"></div>';
yii\bootstrap\Modal::end();
?>

<?php
yii\bootstrap\Modal::begin([
    'header' => '<span id="modalHeaderTitle3"></span>',
    'id' => 'modal3',
    //'size' => 'modal-sm',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => TRUE]
]);
echo "<div id='modalContent3' class='text-center'>
    <form>
        <label>Dinero:</label>
        <input class='form-control' type='text' id='dinero'>
        <label>Total: $<label id= 'totalito'>0.00</label> </label><br>
        <label>Cambio: $<label id= 'cambio'>0.00</label> </label><br>
        <input type='button' onclick='calcularc()' id='calcularCambio' value='Calcular' />
        <input type='button' onclick='comprar()' id='calcularCambio' value='Cobrar' />
    </form>
</div>";
echo '<div id="modal-footer2"></div>';
yii\bootstrap\Modal::end();
?>

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
