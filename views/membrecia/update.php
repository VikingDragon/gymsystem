<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Membrecia */

$this->title = 'Actualizar Membrecia: #' . $model->inventario_idinventario;
$this->params['breadcrumbs'][] = ['label' => 'Membrecias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->inventario_idinventario, 'url' => ['view', 'id' => $model->inventario_idinventario]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="membrecia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'inventario' => $inventario,
    ]) ?>

</div>
