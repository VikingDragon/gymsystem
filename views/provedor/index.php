<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProvedorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Provedors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provedor-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Provedor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idprovedor',
            'nombre',
            'telefono',
            'direccion',
            'estado_idestado',
            // 'nota:ntext',
            // 'contacto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
