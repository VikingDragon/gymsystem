<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articulo".
 *
 * @property integer $inventario_idinventario
 * @property string $codigo
 *
 * @property Inventario $inventarioIdinventario
 * @property Lote $lote
 */
class Articulo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articulo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inventario_idinventario'], 'required'],
            [['inventario_idinventario'], 'integer'],
            [['codigo'], 'string', 'max' => 65],
            [['codigo'], 'unique'],
            [['inventario_idinventario'], 'exist', 'skipOnError' => true, 'targetClass' => Inventario::className(), 'targetAttribute' => ['inventario_idinventario' => 'idinventario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inventario_idinventario' => 'Inventario',
            'codigo' => 'Codigo',
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
    public function getLote()
    {
        return $this->hasOne(Lote::className(), ['articulo_inventario_idinventario' => 'inventario_idinventario']);
    }
}
