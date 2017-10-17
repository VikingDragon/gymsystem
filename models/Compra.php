<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "compra".
 *
 * @property integer $idcompra
 * @property string $fecha
 * @property integer $provedor_idprovedor
 * @property integer $empleado_idempleado
 * @property integer $estado_compra_idestado_compra
 *
 * @property Empleado $empleadoIdempleado
 * @property EstadoCompra $estadoCompraIdestadoCompra
 * @property Provedor $provedorIdprovedor
 * @property DetalleCompra[] $detalleCompras
 */
class Compra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'compra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'provedor_idprovedor', 'empleado_idempleado', 'estado_compra_idestado_compra'], 'required'],
            [['fecha'], 'safe'],
            [['provedor_idprovedor', 'empleado_idempleado', 'estado_compra_idestado_compra'], 'integer'],
            [['empleado_idempleado'], 'exist', 'skipOnError' => true, 'targetClass' => Empleado::className(), 'targetAttribute' => ['empleado_idempleado' => 'idempleado']],
            [['estado_compra_idestado_compra'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoCompra::className(), 'targetAttribute' => ['estado_compra_idestado_compra' => 'idestado_compra']],
            [['provedor_idprovedor'], 'exist', 'skipOnError' => true, 'targetClass' => Provedor::className(), 'targetAttribute' => ['provedor_idprovedor' => 'idprovedor']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcompra' => 'Folio',
            'fecha' => 'Fecha',
            'provedor_idprovedor' => 'Provedor',
            'empleado_idempleado' => 'Empleado',
            'estado_compra_idestado_compra' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleadoIdempleado()
    {
        return $this->hasOne(Empleado::className(), ['idempleado' => 'empleado_idempleado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoCompraIdestadoCompra()
    {
        return $this->hasOne(EstadoCompra::className(), ['idestado_compra' => 'estado_compra_idestado_compra']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvedorIdprovedor()
    {
        return $this->hasOne(Provedor::className(), ['idprovedor' => 'provedor_idprovedor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleCompras()
    {
        return $this->hasMany(DetalleCompra::className(), ['compra_idcompra' => 'idcompra']);
    }
}
