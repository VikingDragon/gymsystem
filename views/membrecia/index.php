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

            //'idmembrecia',
            'descripcion',
            'detalles',
            'personas',
            'costo',
            // 'inicio',
            // 'fin',
            'estadoIdestado.estado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
