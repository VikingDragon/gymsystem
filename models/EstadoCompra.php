<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado_compra".
 *
 * @property integer $idestado_compra
 * @property string $estado
 *
 * @property Compra[] $compras
 */
class EstadoCompra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estado_compra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estado'], 'required'],
            [['estado'], 'string', 'max' => 45],
            [['estado'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idestado_compra' => 'Idestado Compra',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompras()
    {
        return $this->hasMany(Compra::className(), ['estado_compra_idestado_compra' => 'idestado_compra']);
    }
}
