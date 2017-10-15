<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Provedor */

$this->title = 'Update Provedor: ' . $model->idprovedor;
$this->params['breadcrumbs'][] = ['label' => 'Provedors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idprovedor, 'url' => ['view', 'id' => $model->idprovedor]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="provedor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
