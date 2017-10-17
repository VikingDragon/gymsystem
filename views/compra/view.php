<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Compra */

$this->title = "Compra Folio #".$model->idcompra;
$this->params['breadcrumbs'][] = ['label' => 'Compras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="compra-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idcompra',
            'fecha',
            [
                'label' => 'Provedor',
                'value' => $model->provedorIdprovedor->nombre,
            ],
            [
                'label' => 'Empleado',
                'value' => $model->empleadoIdempleado->nombre." ".$model->empleadoIdempleado->apaterno,
            ],
        ],
    ]) ?>
    <table class="table">
        <tr>
            <th>Nombre</th>
            <th>Precio de venta</th>
            <th>Costo</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Caducidad</th>
            <th>Lote</th>
            <th>Cantidad Actual</th>
            <th>Detalles</th>
        </tr>
    <?php
        $total= 0;
        foreach ($model->detalleCompras as $key => $detalle) {
            $articulo = \app\models\Inventario::findOne($detalle->loteIdlote->articulo_inventario_idinventario);
            echo "<tr>";
            echo "<td>".$articulo->nombre."</td>";
            echo "<td>$".$articulo->precio."</td>";
            echo "<td>$".$detalle->loteIdlote->costo."</td>";
            echo "<td>".$detalle->loteIdlote->cantidad."</td>";
            echo "<td>#".($detalle->loteIdlote->cantidad*$detalle->loteIdlote->costo)."</td>";
            echo "<td>".$detalle->loteIdlote->caducidad."</td>";
            echo "<td>".$detalle->loteIdlote->lote."</td>";
            echo "<td>".$detalle->loteIdlote->cantidad_actual."</td>";
            echo "<td>".$detalle->detalles."</td>";
            $total += $detalle->loteIdlote->cantidad*$detalle->loteIdlote->costo;
            echo "</tr>";
        }
    ?>
        <tr>
            <td colspan="5">Total</td>
            <td colspan="4">$<?= $total?></td>
        </tr>
    </table>
</div>
