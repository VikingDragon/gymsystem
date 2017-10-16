<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lote".
 *
 * @property string $idlote
 * @property integer $articulo_inventario_idinventario
 * @property string $lote
 * @property string $caducidad
 * @property integer $cantidad
 * @property integer $cantidad_actual
 * @property double $costo
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
            [['idlote', 'articulo_inventario_idinventario', 'lote', 'cantidad'], 'required'],
            [['articulo_inventario_idinventario', 'cantidad', 'cantidad_actual'], 'integer'],
            [['caducidad'], 'safe'],
            [['costo'], 'number'],
            [['idlote', 'lote'], 'string', 'max' => 45],
            [['articulo_inventario_idinventario'], 'unique'],
            [['idlote'], 'unique'],
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
            'articulo_inventario_idinventario' => 'Articulo Inventario Idinventario',
            'lote' => 'Lote',
            'caducidad' => 'Caducidad',
            'cantidad' => 'Cantidad',
            'cantidad_actual' => 'Cantidad Actual',
            'costo' => 'Costo',
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
}
