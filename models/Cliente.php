<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property integer $idcliente
 * @property string $nombre
 * @property string $apaterno
 * @property string $amaterno
 * @property string $nacimiento
 * @property integer $sexo_idsexo
 * @property integer $usuario_idusuario
 *
 * @property Sexo $sexoIdsexo
 * @property Usuario $usuarioIdusuario
 * @property Correo[] $correos
 * @property GrupoHasCliente[] $grupoHasClientes
 * @property Grupo[] $grupoIdgrupos
 * @property Historial[] $historials
 * @property HistorialIngresos[] $historialIngresos
 * @property Telefono[] $telefonos
 * @property Venta[] $ventas
 * @property VentaMembrecia[] $ventaMembrecias
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apaterno', 'amaterno', 'nacimiento', 'sexo_idsexo', 'usuario_idusuario'], 'required'],
            [['nacimiento'], 'safe'],
            [['sexo_idsexo', 'usuario_idusuario'], 'integer'],
            [['nombre', 'apaterno', 'amaterno'], 'string', 'max' => 45],
            [['sexo_idsexo'], 'exist', 'skipOnError' => true, 'targetClass' => Sexo::className(), 'targetAttribute' => ['sexo_idsexo' => 'idsexo']],
            [['usuario_idusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usuario_idusuario' => 'idusuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcliente' => 'Idcliente',
            'nombre' => 'Nombre',
            'apaterno' => 'Apaterno',
            'amaterno' => 'Amaterno',
            'nacimiento' => 'Nacimiento',
            'sexo_idsexo' => 'Sexo Idsexo',
            'usuario_idusuario' => 'Usuario Idusuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSexoIdsexo()
    {
        return $this->hasOne(Sexo::className(), ['idsexo' => 'sexo_idsexo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioIdusuario()
    {
        return $this->hasOne(Usuario::className(), ['idusuario' => 'usuario_idusuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorreos()
    {
        return $this->hasMany(Correo::className(), ['cliente_idcliente' => 'idcliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoHasClientes()
    {
        return $this->hasMany(GrupoHasCliente::className(), ['cliente_idcliente' => 'idcliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoIdgrupos()
    {
        return $this->hasMany(Grupo::className(), ['idgrupo' => 'grupo_idgrupo'])->viaTable('grupo_has_cliente', ['cliente_idcliente' => 'idcliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorials()
    {
        return $this->hasMany(Historial::className(), ['cliente_idcliente' => 'idcliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialIngresos()
    {
        return $this->hasMany(HistorialIngresos::className(), ['cliente_idcliente' => 'idcliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTelefonos()
    {
        return $this->hasMany(Telefono::className(), ['cliente_idcliente' => 'idcliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Venta::className(), ['cliente_idcliente' => 'idcliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentaMembrecias()
    {
        return $this->hasMany(VentaMembrecia::className(), ['cliente_idcliente' => 'idcliente']);
    }
}
