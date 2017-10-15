<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Membrecia */

$this->title = $model->inventarioIdinventario->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Membrecias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membrecia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->inventario_idinventario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->inventario_idinventario], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'inventarioIdinventario.nombre',
            'inventarioIdinventario.precio',
            'inventarioIdinventario.descripcion',
            'personas',
            'inicio',
            'fin',
            //'estado_idestado',
        ],
    ]) ?>

</div>
