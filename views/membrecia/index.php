<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MembreciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Membrecias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membrecia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nueva Membrecia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'inventario_idinventario',
            [
                'attribute' => 'nombre',
                'label' => 'Nombre',
                'format' => 'raw',              
                'value'=>function ($data) {
                    return $data->inventarioIdinventario->nombre;
                },
            ],
            [
                'attribute' => 'precio',
                'label' => 'Precio',
                'format' => 'raw',              
                'value'=>function ($data) {
                    return "$".$data->inventarioIdinventario->precio;
                },
            ],
            'personas',
            //'inicio',
            //'fin',
            //'estado_idestado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
