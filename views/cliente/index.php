<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar Cliente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
                    return $data->historial->estadoIdestado->estado;
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {reactivar}',
                'buttons'=>[
                    'delete' => function ($url, $model, $key) {
                        return $model->historial->estado_idestado === 1 ? Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,['title'=>'Eliminar',
                            'data' => [
                                'confirm' => '¿Estas seguro que deseas dar de baja este cliente?',
                                'method' => 'post',
                            ],
                        ]) : '';
                    },
                    'reactivar' => function ($url, $model, $key) {
                        return $model->historial->estado_idestado === 2 ? Html::a('<span class="glyphicon glyphicon-ok-circle"></span>', $url,['title'=>'Reactivar',
                            'data' => [
                                'confirm' => '¿Estas seguro que deseas reactivar este cliente?',
                                'method' => 'post',
                            ],
                        ]) : '';
                    }
                ],
            ],
        ],
    ]); ?>
</div>
