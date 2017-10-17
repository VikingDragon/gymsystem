<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "venta".
 *
 * @property integer $idventa
 * @property string $fecha
 * @property integer $cliente_idcliente
 * @property integer $empleado_idempleado
 * @property integer $estado
 *
 * @property DetalleVenta[] $detalleVentas
 * @property Cliente $clienteIdcliente
 * @property Empleado $empleadoIdempleado
 */
class Venta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'venta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha'], 'safe'],
            [['cliente_idcliente', 'empleado_idempleado', 'estado'], 'required'],
            [['cliente_idcliente', 'empleado_idempleado', 'estado'], 'integer'],
            [['cliente_idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cliente_idcliente' => 'idcliente']],
            [['empleado_idempleado'], 'exist', 'skipOnError' => true, 'targetClass' => Empleado::className(), 'targetAttribute' => ['empleado_idempleado' => 'idempleado']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idventa' => 'Idventa',
            'fecha' => 'Fecha',
            'cliente_idcliente' => 'Cliente Idcliente',
            'empleado_idempleado' => 'Empleado Idempleado',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleVentas()
    {
        return $this->hasMany(DetalleVenta::className(), ['venta_idventa' => 'idventa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClienteIdcliente()
    {
        return $this->hasOne(Cliente::className(), ['idcliente' => 'cliente_idcliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleadoIdempleado()
    {
        return $this->hasOne(Empleado::className(), ['idempleado' => 'empleado_idempleado']);
    }
}
