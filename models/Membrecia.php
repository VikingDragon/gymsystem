<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "membrecia".
 *
 * @property integer $inventario_idinventario
 * @property integer $personas
 * @property string $inicio
 * @property string $fin
 * @property integer $estado_idestado
 *
 * @property Grupo[] $grupos
 * @property Historial[] $historials
 * @property Estado $estadoIdestado
 * @property Inventario $inventarioIdinventario
 */
class Membrecia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'membrecia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inventario_idinventario', 'personas', 'estado_idestado'], 'required'],
            [['inventario_idinventario', 'personas', 'estado_idestado'], 'integer'],
            [['inicio', 'fin'], 'safe'],
            [['estado_idestado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['estado_idestado' => 'idestado']],
            [['inventario_idinventario'], 'exist', 'skipOnError' => true, 'targetClass' => Inventario::className(), 'targetAttribute' => ['inventario_idinventario' => 'idinventario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inventario_idinventario' => 'Inventario Idinventario',
            'personas' => 'Personas',
            'inicio' => 'Inicio',
            'fin' => 'Fin',
            'estado_idestado' => 'Estado Idestado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupos()
    {
        return $this->hasMany(Grupo::className(), ['membrecia_inventario_idinventario' => 'inventario_idinventario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorials()
    {
        return $this->hasMany(Historial::className(), ['membrecia_inventario_idinventario' => 'inventario_idinventario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoIdestado()
    {
        return $this->hasOne(Estado::className(), ['idestado' => 'estado_idestado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarioIdinventario()
    {
        return $this->hasOne(Inventario::className(), ['idinventario' => 'inventario_idinventario']);
    }
}
