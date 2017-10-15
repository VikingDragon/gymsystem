<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "provedor".
 *
 * @property integer $idprovedor
 * @property string $nombre
 * @property string $telefono
 * @property string $direccion
 * @property integer $estado_idestado
 * @property string $nota
 * @property string $contacto
 *
 * @property Compra[] $compras
 * @property Estado $estadoIdestado
 */
class Provedor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provedor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'estado_idestado'], 'required'],
            [['estado_idestado'], 'integer'],
            [['nota'], 'string'],
            [['nombre', 'telefono'], 'string', 'max' => 45],
            [['direccion'], 'string', 'max' => 200],
            [['contacto'], 'string', 'max' => 100],
            [['estado_idestado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['estado_idestado' => 'idestado']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idprovedor' => 'Idprovedor',
            'nombre' => 'Nombre',
            'telefono' => 'Telefono',
            'direccion' => 'Direccion',
            'estado_idestado' => 'Estado Idestado',
            'nota' => 'Nota',
            'contacto' => 'Contacto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompras()
    {
        return $this->hasMany(Compra::className(), ['provedor_idprovedor' => 'idprovedor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstadoIdestado()
    {
        return $this->hasOne(Estado::className(), ['idestado' => 'estado_idestado']);
    }
}
