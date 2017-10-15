<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Membrecia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="membrecia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($inventario, 'nombre')->textInput(['placeholder'=>'Nombre con el cual se identifica la membrecia Ejemplo "Prompocion Membrecia Grupal 5 personas"','maxlength' => true]) ?>

    <?= $form->field($inventario, 'descripcion')->textArea(['placeholder'=>'Detalles Extras Ejemplo "Solo valida en grupos de 5 personas"']) ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'personas')->textInput(['placeholder'=>'el numero requeridas']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($inventario, 'precio')->textInput(['placeholder'=>'Costo mensual']) ?>
        </div>

        <div class="col-md-4">
            <p class="bg-primary informacion">Si colocas fecha de inicio/fin la membrecia solo sera valida entre las fechas seleccionadas, este campo es opcional si se deja en blanco la membrecia siempre sera valida</p>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-4">
            <?= $form->field($model, 'inicio')->widget(DatePicker::classname(), [
                'options'=>['style'=>'width:100%;', 'class'=>'form-control','placeholder'=>'Inicio de promocion'],
                //'language' => 'ru',
                'clientOptions'=>['changeYear'=>true,'changeMonth'=>true,'maxDate'=>"2y",'minDate'=>"-0y"],
                'dateFormat' => 'yyyy-MM-dd',
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'fin')->widget(DatePicker::classname(), [
                'options'=>['style'=>'width:100%;', 'class'=>'form-control','placeholder'=>'Termino de promocion'],
                //'language' => 'ru',
                'clientOptions'=>['changeYear'=>true,'changeMonth'=>true,'maxDate'=>"2y",'minDate'=>"-0y"],
                'dateFormat' => 'yyyy-MM-dd',
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<style type="text/css">
    .informacion{
        padding: 5px;
        text-align: justify;
        border-radius: 18px;
    }
</style>