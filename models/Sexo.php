<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sexo".
 *
 * @property integer $idsexo
 * @property string $sexo
 *
 * @property Cliente[] $clientes
 */
class Sexo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sexo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sexo'], 'required'],
            [['sexo'], 'string', 'max' => 45],
            [['sexo'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idsexo' => 'Idsexo',
            'sexo' => 'Sexo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Cliente::className(), ['sexo_idsexo' => 'idsexo']);
    }
}
