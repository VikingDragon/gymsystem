<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Membrecia */

$this->title = 'Actualizar Membrecia: #' . $model->idmembrecia;
$this->params['breadcrumbs'][] = ['label' => 'Membrecias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idmembrecia, 'url' => ['view', 'id' => $model->idmembrecia]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="membrecia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
