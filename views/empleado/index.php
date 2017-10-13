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
                'filter'=>array(null => 'Todo',"1"=>"Activo","2"=>"Baja"),
                'format' => 'raw',              
                'value'=>function ($data) {
                    return $data->estadoEmpleado->estadoIdestado->estado;
                },
            ],

            

            //'nacimiento',
            // 'correo',
            // 'telefono',
            // 'usuario_idusuario',
            // 'sexo_idsexo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
