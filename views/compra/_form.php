<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Compra */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="compra-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'provedor_idprovedor')->textInput() ?>

    <?= $form->field($model, 'empleado_idempleado')->textInput() ?>

    <?= $form->field($model, 'estado_compra_idestado_compra')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
