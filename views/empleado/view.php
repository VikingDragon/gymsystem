<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Empleado */

$this->title = "Detalles del empleado # ".$model->idempleado;
$this->params['breadcrumbs'][] = ['label' => 'Empleados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empleado-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idempleado], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idempleado], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Estas seguro de querer eliminar este usuario?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idempleado',
            [
                'label'=> 'Usuario',
                'value' => $model->usuarioIdusuario->username
            ],
            [
                'label'=> 'Estado',
                'value' => $model->estadoEmpleado->estadoIdestado->estado
            ],
            [
                'label'=>$model->estadoEmpleado->estadoIdestado->estado?"Fecha de ingreso":"Fecha de baja",
                'value'=>$model->estadoEmpleado->fecha
            ],
            [
                'label'=> 'Nombre',
                'value' => $model->nombre." ".$model->apaterno." ".$model->amaterno
            ],
            'nacimiento',
            'sexoIdsexo.sexo',
            'correo',
            'telefono',
            
        ],
    ]) ?>

</div>
