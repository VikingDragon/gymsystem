<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "historial".
 *
 * @property integer $idhistorial
 * @property string $fecha
 * @property integer $cliente_idcliente
 * @property integer $estado_idestado
 * @property integer $empleado_idempleado
 *
 * @property Cliente $clienteIdcliente
 * @property Empleado $empleadoIdempleado
 * @property Estado $estadoIdestado
 */
class Historial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'historial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'cliente_idcliente', 'estado_idestado', 'empleado_idempleado'], 'required'],
            [['fecha'], 'safe'],
            [['cliente_idcliente', 'estado_idestado', 'empleado_idempleado'], 'integer'],
            [['cliente_idcliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cliente_idcliente' => 'idcliente']],
            [['empleado_idempleado'], 'exist', 'skipOnError' => true, 'targetClass' => Empleado::className(), 'targetAttribute' => ['empleado_idempleado' => 'idempleado']],
            [['estado_idestado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['estado_idestado' => 'idestado']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idhistorial' => 'Idhistorial',
            'fecha' => 'Fecha',
            'cliente_idcliente' => 'Cliente Idcliente',
            'estado_idestado' => 'Estado Idestado',
            'empleado_idempleado' => 'Empleado Idempleado',
        ];
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoIdestado()
    {
        return $this->hasOne(Estado::className(), ['idestado' => 'estado_idestado']);
    }
}
