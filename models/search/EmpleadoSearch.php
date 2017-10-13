<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Empleado;

/**
 * EmpleadoSearch represents the model behind the search form about `app\models\Empleado`.
 */
class EmpleadoSearch extends Empleado
{
    public $usuario;
    public $estado;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idempleado', 'usuario_idusuario', 'sexo_idsexo'], 'integer'],
            [['nombre', 'apaterno', 'amaterno', 'nacimiento', 'correo', 'telefono', 'usuario', 'estado'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Empleado::find();
        $query->joinWith('usuarioIdusuario');
        $query->leftJoin('estado_empleado', 'estado_empleado.idestado_empleado = (
  SELECT idestado_empleado FROM `estado_empleado` WHERE empleado_idempleado = empleado.idempleado ORDER BY idestado_empleado DESC LIMIT 1)');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['usuario'] = [
            'asc' => ['username' => SORT_ASC],
            'desc' => ['username' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['estado'] = [
            'asc' => ['idestado_empleado' => SORT_ASC],
            'desc' => ['idestado_empleado' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idempleado' => $this->idempleado,
            'nacimiento' => $this->nacimiento,
            'usuario_idusuario' => $this->usuario_idusuario,
            'sexo_idsexo' => $this->sexo_idsexo,
            'estado_idestado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apaterno', $this->apaterno])
            ->andFilterWhere(['like', 'amaterno', $this->amaterno])
            ->andFilterWhere(['like', 'correo', $this->correo])
            ->andFilterWhere(['like', 'telefono', $this->telefono]);
        $query->andFilterWhere(['like', 'username', $this->usuario]);

        return $dataProvider;
    }
}
