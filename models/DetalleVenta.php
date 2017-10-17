<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detalle_venta".
 *
 * @property integer $iddetalle_venta
 * @property integer $venta_idventa
 * @property double $precio
 * @property double $costo
 * @property integer $cantidad
 * @property integer $inventario_idinventario
 *
 * @property Inventario $inventarioIdinventario
 * @property Venta $ventaIdventa
 */
class DetalleVenta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detalle_venta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['venta_idventa', 'precio', 'cantidad', 'inventario_idinventario'], 'required'],
            [['venta_idventa', 'cantidad', 'inventario_idinventario'], 'integer'],
            [['precio', 'costo'], 'number'],
            [['inventario_idinventario'], 'exist', 'skipOnError' => true, 'targetClass' => Inventario::className(), 'targetAttribute' => ['inventario_idinventario' => 'idinventario']],
            [['venta_idventa'], 'exist', 'skipOnError' => true, 'targetClass' => Venta::className(), 'targetAttribute' => ['venta_idventa' => 'idventa']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'iddetalle_venta' => 'Iddetalle Venta',
            'venta_idventa' => 'Venta Idventa',
            'precio' => 'Precio',
            'costo' => 'Costo',
            'cantidad' => 'Cantidad',
            'inventario_idinventario' => 'Inventario Idinventario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarioIdinventario()
    {
        return $this->hasOne(Inventario::className(), ['idinventario' => 'inventario_idinventario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentaIdventa()
    {
        return $this->hasOne(Venta::className(), ['idventa' => 'venta_idventa']);
    }
}
