<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empleado".
 *
 * @property integer $idempleado
 * @property string $nombre
 * @property string $apaterno
 * @property string $amaterno
 * @property string $nacimiento
 * @property string $correo
 * @property string $telefono
 * @property integer $usuario_idusuario
 * @property integer $sexo_idsexo
 *
 * @property Caja[] $cajas
 * @property Sexo $sexoIdsexo
 * @property Usuario $usuarioIdusuario
 * @property HistorialEmpleado[] $historialEmpleados
 */
class Empleado extends \yii\db\ActiveRecord
{
    public $tipo;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'empleado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo', 'nombre', 'apaterno', 'amaterno', 'nacimiento', 'usuario_idusuario', 'sexo_idsexo'], 'required'],
            [['nacimiento'], 'safe'],
            [['correo'], 'email'],
            [['usuario_idusuario', 'sexo_idsexo', 'telefono'], 'integer'],
            [['nombre', 'apaterno', 'amaterno', 'tipo'], 'string', 'max' => 45],
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
            'idempleado' => 'Folio empleado',
            'nombre' => 'Nombre',
            'apaterno' => 'Apellido paterno',
            'amaterno' => 'Apellido materno',
            'nacimiento' => 'Fecha de nacimiento',
            'correo' => 'Correo',
            'telefono' => 'Telefono',
            'usuario_idusuario' => 'Usuario',
            'sexo_idsexo' => 'Sexo',
            'tipo' => 'Tipo de usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCajas()
    {
        return $this->hasMany(Caja::className(), ['empleado_idempleado' => 'idempleado']);
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
    public function getEstadoEmpleado() 
    { 
        return $this->hasOne(EstadoEmpleado::className(), ['empleado_idempleado' => 'idempleado'])->orderBy(['idestado_empleado' => SORT_DESC]); 
    } 

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getEstadoEmpleados() 
    { 
        return $this->hasMany(EstadoEmpleado::className(), ['empleado_idempleado' => 'idempleado']); 
    } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistorialEmpleados()
    {
        return $this->hasMany(HistorialEmpleado::className(), ['empleado_idempleado' => 'idempleado']);
    }
}
