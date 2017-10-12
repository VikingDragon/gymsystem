<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado_empleado".
 *
 * @property integer $idestado_empleado
 * @property string $fecha
 * @property integer $estado_idestado
 * @property integer $empleado_idempleado
 *
 * @property Empleado $empleadoIdempleado
 * @property Estado $estadoIdestado
 */
class EstadoEmpleado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estado_empleado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'estado_idestado', 'empleado_idempleado'], 'required'],
            [['fecha'], 'safe'],
            [['estado_idestado', 'empleado_idempleado'], 'integer'],
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
            'idestado_empleado' => 'Idestado Empleado',
            'fecha' => 'Fecha',
            'estado_idestado' => 'Estado Idestado',
            'empleado_idempleado' => 'Empleado Idempleado',
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
    public function getEstadoIdestado()
    {
        return $this->hasOne(Estado::className(), ['idestado' => 'estado_idestado']);
    }
}
