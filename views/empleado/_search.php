<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\EmpleadoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empleado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idempleado') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'apaterno') ?>

    <?= $form->field($model, 'amaterno') ?>

    <?= $form->field($model, 'nacimiento') ?>

    <?php // echo $form->field($model, 'correo') ?>

    <?php // echo $form->field($model, 'telefono') ?>

    <?php // echo $form->field($model, 'usuario_idusuario') ?>

    <?php // echo $form->field($model, 'sexo_idsexo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
