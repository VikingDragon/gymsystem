<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\MembreciaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="membrecia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idmembrecia') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'detalles') ?>

    <?= $form->field($model, 'personas') ?>

    <?= $form->field($model, 'costo') ?>

    <?php // echo $form->field($model, 'inicio') ?>

    <?php // echo $form->field($model, 'fin') ?>

    <?php // echo $form->field($model, 'estado_idestado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
