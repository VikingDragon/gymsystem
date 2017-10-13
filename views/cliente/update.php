<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = 'Actualizar Cliente: #' . $model->idcliente;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcliente, 'url' => ['view', 'idcliente' => $model->idcliente, 'usuario_idusuario' => $model->usuario_idusuario]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="cliente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'usuario' => $usuario,
    ]) ?>

</div>
