<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\EmpleadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Empleados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empleado-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Empleado', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idempleado',
            [
                'attribute' => 'usuario',
                'label' => 'Usuario',
                'format' => 'raw',              
                'value'=>function ($data) {
                    return $data->usuarioIdusuario->username;
                },
            ],
            'nombre',
            'apaterno',
            'amaterno',
            [
                'attribute' => 'estado',
                'label' => 'Estado',
                'filter'=>array("1"=>"Activo","2"=>"Baja"),
                'format' => 'raw',              
                'value'=>function ($data) {
                    return $data->estadoEmpleado->estadoIdestado->estado;
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {reactivar}',
                'buttons'=>[
                    'delete' => function ($url, $model, $key) {
                        return $model->estadoEmpleado->estado_idestado === 1 ? Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,['title'=>'Eliminar',
                        'data' => [
                            'confirm' => '¿Estas seguro que deseas dar de baja este empleado?',
                            'method' => 'post',
                        ],]) : '';
                    },
                    'reactivar' => function ($url, $model, $key) {
                        return $model->estadoEmpleado->estado_idestado === 2 ? Html::a('<span class="glyphicon glyphicon-ok-circle"></span>', $url,['title'=>'Reactivar',
                        'data' => [
                            'confirm' => '¿Estas seguro que deseas reactivar este empleado?',
                            'method' => 'post',
                        ],]) : '';
                    }
                ],
            ],
        ],
    ]); ?>
</div>
