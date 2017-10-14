<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Membrecia */

$this->title = $model->descripcion;
$this->params['breadcrumbs'][] = ['label' => 'Membrecias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membrecia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idmembrecia], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idmembrecia], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Realmente deseas eliminar esta membrecia?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idmembrecia',
            'descripcion',
            'detalles',
            'personas',
            'costo',
            'estadoIdestado.estado',
            'inicio',
            'fin',
            
        ],
    ]) ?>

</div>
