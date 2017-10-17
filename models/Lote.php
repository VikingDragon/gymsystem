<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lote".
 *
 * @property integer $idlote
 * @property string $lote
 * @property string $caducidad
 * @property integer $cantidad
 * @property integer $cantidad_actual
 * @property double $costo
 * @property integer $articulo_inventario_idinventario
 *
 * @property DetalleCompra[] $detalleCompras
 * @property Articulo $articuloInventarioIdinventario
 */
class Lote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['caducidad'], 'safe'],
            [['cantidad', 'articulo_inventario_idinventario','costo'], 'required'],
            [['cantidad', 'cantidad_actual', 'articulo_inventario_idinventario'], 'integer'],
            [['costo'], 'number'],
            [['lote'], 'string', 'max' => 45],
            [['articulo_inventario_idinventario'], 'exist', 'skipOnError' => true, 'targetClass' => Articulo::className(), 'targetAttribute' => ['articulo_inventario_idinventario' => 'inventario_idinventario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idlote' => 'Idlote',
            'lote' => 'Lote',
            'caducidad' => 'Caducidad',
            'cantidad' => 'Cantidad',
            'cantidad_actual' => 'Cantidad Actual',
            'costo' => 'Costo',
            'articulo_inventario_idinventario' => 'Articulo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleCompras()
    {
        return $this->hasMany(DetalleCompra::className(), ['lote_idlote' => 'idlote']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticuloInventarioIdinventario()
    {
        return $this->hasOne(Articulo::className(), ['inventario_idinventario' => 'articulo_inventario_idinventario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarioIdinventario()
    {
        return $this->hasOne(Inventario::className(), ['idinventario' => 'articulo_inventario_idinventario']);
    }
}
