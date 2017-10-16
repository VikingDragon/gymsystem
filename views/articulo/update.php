<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Articulo */

$this->title = 'Update Articulo: ' . $model->inventario_idinventario;
$this->params['breadcrumbs'][] = ['label' => 'Articulos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->inventario_idinventario, 'url' => ['view', 'id' => $model->inventario_idinventario]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="articulo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
