<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Empleado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empleado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        $sexo= ArrayHelper::map(\app\models\Sexo::find()->orderBy('sexo')->all(), 'idsexo', 'sexo');
        $rol= ArrayHelper::map(\app\models\AuthItem::find()->orderBy('name')->all(), 'name', 'name');
    ?>
    <div class="row">
        <div class="col-md-4"><?= $form->field($usuario, 'username')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-4"><?= $form->field($usuario, 'password')->passwordInput(['maxlength' => true]) ?></div>
        <div class="col-md-4">
            <?=
                $form->field($model, 'tipo')
                    ->dropDownList($rol,['prompt'=>'Selecciona tipo de usuario']);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'apaterno')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'amaterno')->textInput(['maxlength' => true]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'nacimiento')->widget(DatePicker::classname(), [
                'options'=>['style'=>'width:100%;', 'class'=>'form-control'],
                //'language' => 'ru',
                'clientOptions'=>['changeYear'=>true,'changeMonth'=>true,'maxDate'=>"-12y",'minDate'=>"-57y"],
                'dateFormat' => 'yyyy-MM-dd',
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'correo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?=
                $form->field($model, 'sexo_idsexo')
                    ->dropDownList($sexo,['prompt'=>'Selecciona el Sexo']);
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
