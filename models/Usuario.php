<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "usuario".
 *
 * @property int $idusuario
 * @property string $username
 * @property string $password
 * @property string $default
 * @property string $auth_key
 * @property string $password_reset_token
 *
 * @property Cliente[] $clientes
 */
class Usuario extends \yii\db\ActiveRecord  implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password'], 'string', 'max' => 255],
            [['default'], 'string', 'max' => 45],
            [['auth_key', 'password_reset_token'], 'string', 'max' => 100],
            [['username'], 'unique'], 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idusuario' => 'Folio',
            'username' => 'Usuario',
            'password' => 'Contraseña',
            'default' => 'Default',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
        ];
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($idusuario)
    {
        return static::findOne($idusuario);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->idusuario;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
                $this->default = 1;
                $this->password=md5($this->password);
            }
            return true;
        }
        return false;
    }

    public function validatePassword($password)
    {
        if($this->password === md5($password)){
            return true;
        }else{    
            return false;
        }
    }

    public static function findByUsername($username)
    {
        return static::find()->Where(['username' => $username])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasOne(Cliente::className(), ['usuario_idusuario' => 'idusuario']);
    }

     public function getEmpleado()
    {
        return $this->hasOne(Empleado::className(), ['usuario_idusuario' => 'idusuario']);
    }
}
