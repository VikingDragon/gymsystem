<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Membrecia */

$this->title = 'Create Membrecia';
$this->params['breadcrumbs'][] = ['label' => 'Membrecias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="membrecia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
