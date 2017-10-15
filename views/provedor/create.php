<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Provedor */

$this->title = 'Registrar Provedor';
$this->params['breadcrumbs'][] = ['label' => 'Provedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provedor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
