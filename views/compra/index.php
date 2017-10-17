<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CompraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Compras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compra-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fecha',
            [
                'attribute' => 'provedor',
                'label' => 'Provedor',
                'format' => 'raw',              
                'value'=>function ($data) {
                    return $data->provedorIdprovedor->nombre;
                },
            ],
            [
                'attribute' => 'empleado',
                'label' => 'Empleado',
                'format' => 'raw',              
                'value'=>function ($data) {
                    return $data->empleadoIdempleado->nombre." ".$data->empleadoIdempleado->apaterno;
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
            ],
        ],
    ]); ?>
</div>
