<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\CompraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="compra-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idcompra') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'provedor_idprovedor') ?>

    <?= $form->field($model, 'empleado_idempleado') ?>

    <?= $form->field($model, 'estado_compra_idestado_compra') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
