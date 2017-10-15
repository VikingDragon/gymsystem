<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Provedor */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Provedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provedor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idprovedor], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idprovedor], [
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
            //'idprovedor',
            'nombre',
            'telefono',
            'direccion',
            'estado_idestado',
            'nota:ntext',
            'contacto',
        ],
    ]) ?>

</div>
