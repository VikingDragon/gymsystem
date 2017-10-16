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

    <p>
        <?= Html::a('Create Compra', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idcompra',
            'fecha',
            'provedor_idprovedor',
            'empleado_idempleado',
            'estado_compra_idestado_compra',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
