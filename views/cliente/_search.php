<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\ClienteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cliente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idcliente') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'apaterno') ?>

    <?= $form->field($model, 'amaterno') ?>

    <?= $form->field($model, 'nacimiento') ?>

    <?php // echo $form->field($model, 'sexo_idsexo') ?>

    <?php // echo $form->field($model, 'usuario_idusuario') ?>

    <?php // echo $form->field($model, 'empleado_idempleado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
