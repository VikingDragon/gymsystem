<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = "Detalles del cliente #".$model->idcliente;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'idcliente' => $model->idcliente, 'usuario_idusuario' => $model->usuario_idusuario], ['class' => 'btn btn-primary']) ?>
        <?php
            if($model->historial->estado_idestado==1){
                echo Html::a('Eliminar', ['delete', 'idcliente' => $model->idcliente, 'usuario_idusuario' => $model->usuario_idusuario], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '¿Estas seguro que deseas dar de baja este cliente?',
                        'method' => 'post',
                    ],
                ]); 
            }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idcliente',
            [
                'label'=> 'Usuario',
                'value' => $model->usuarioIdusuario->username
            ],
            [
                'label'=> 'Estado',
                'value' => $model->historial->estadoIdestado->estado
            ],
            [
                'label'=>$model->historial->estado_idestado==1?"Fecha de ingreso":"Fecha de baja",
                'value'=>$model->historial->fecha
            ],
            [
                'label'=> 'Nombre',
                'value' => $model->nombre." ".$model->apaterno." ".$model->amaterno
            ],
            'sexoIdsexo.sexo',
            [
                'label'=> 'Registrado Por',
                'value' => $model->empleadoIdempleado->nombre." ".$model->empleadoIdempleado->apaterno." ".$model->empleadoIdempleado->amaterno
            ],
            [
                'label'=> 'Dado de baja por',
                'value' => $model->historial->estado_idestado==2?$model->historial->empleadoIdempleado->nombre.' '.$model->historial->empleadoIdempleado->apaterno.' '.$model->historial->empleadoIdempleado->amaterno:null
            ],
        ],
    ]) ?>

</div>
