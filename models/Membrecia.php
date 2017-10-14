<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "membrecia".
 *
 * @property integer $idmembrecia
 * @property string $descripcion
 * @property string $detalles
 * @property integer $personas
 * @property double $costo
 * @property string $inicio
 * @property string $fin
 * @property integer $estado_idestado
 *
 * @property Grupo[] $grupos
 * @property Estado $estadoIdestado
 * @property VentaMembrecia[] $ventaMembrecias
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
            [['descripcion', 'detalles', 'personas', 'costo', 'estado_idestado'], 'required'],
            [['personas', 'estado_idestado'], 'integer'],
            [['costo'], 'number'],
            [['inicio', 'fin'], 'safe'],
            [['descripcion'], 'string', 'max' => 45],
            [['detalles'], 'string', 'max' => 200],
            [['estado_idestado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['estado_idestado' => 'idestado']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idmembrecia' => 'Idmembrecia',
            'descripcion' => 'Descripcion',
            'detalles' => 'Detalles',
            'personas' => 'Personas',
            'costo' => 'Costo',
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
        return $this->hasMany(Grupo::className(), ['membrecia_idmembrecia' => 'idmembrecia']);
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
    public function getVentaMembrecias()
    {
        return $this->hasMany(VentaMembrecia::className(), ['membrecia_idmembrecia' => 'idmembrecia']);
    }
}
