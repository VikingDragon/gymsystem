<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inventario".
 *
 * @property integer $idinventario
 * @property string $nombre
 * @property string $descripcion
 * @property double $precio
 *
 * @property Articulo $articulo
 * @property DetalleVenta[] $detalleVentas
 * @property Membrecia $membrecia
 */
class Inventario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inventario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'precio'], 'required'],
            [['descripcion'], 'string'],
            [['precio'], 'number'],
            [['nombre'], 'string', 'max' => 45],
            [['nombre'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idinventario' => 'Idinventario',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'precio' => 'Precio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticulo()
    {
        return $this->hasOne(Articulo::className(), ['inventario_idinventario' => 'idinventario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleVentas()
    {
        return $this->hasMany(DetalleVenta::className(), ['inventario_idinventario' => 'idinventario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembrecia()
    {
        return $this->hasOne(Membrecia::className(), ['inventario_idinventario' => 'idinventario']);
    }
}
