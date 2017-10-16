<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detalle_compra".
 *
 * @property integer $iddetalle_compra
 * @property integer $compra_idcompra
 * @property string $detalles
 * @property string $lote_idlote
 *
 * @property Compra $compraIdcompra
 * @property Lote $loteIdlote
 */
class DetalleCompra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detalle_compra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['compra_idcompra', 'lote_idlote'], 'required'],
            [['compra_idcompra'], 'integer'],
            [['detalles'], 'string'],
            [['lote_idlote'], 'string', 'max' => 45],
            [['compra_idcompra'], 'exist', 'skipOnError' => true, 'targetClass' => Compra::className(), 'targetAttribute' => ['compra_idcompra' => 'idcompra']],
            [['lote_idlote'], 'exist', 'skipOnError' => true, 'targetClass' => Lote::className(), 'targetAttribute' => ['lote_idlote' => 'idlote']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'iddetalle_compra' => 'Iddetalle Compra',
            'compra_idcompra' => 'Compra Idcompra',
            'detalles' => 'Detalles',
            'lote_idlote' => 'Lote Idlote',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompraIdcompra()
    {
        return $this->hasOne(Compra::className(), ['idcompra' => 'compra_idcompra']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoteIdlote()
    {
        return $this->hasOne(Lote::className(), ['idlote' => 'lote_idlote']);
    }
}
