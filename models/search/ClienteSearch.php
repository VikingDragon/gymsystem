<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cliente;

/**
 * ClienteSearch represents the model behind the search form about `app\models\Cliente`.
 */
class ClienteSearch extends Cliente
{
    public $usuario;
    public $estado;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcliente', 'sexo_idsexo', 'usuario_idusuario', 'empleado_idempleado'], 'integer'],
            [['nombre', 'apaterno', 'amaterno', 'nacimiento', 'usuario', 'estado'], 'safe'],
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
        $query = Cliente::find();
        $query->joinWith('usuarioIdusuario');
        $query->leftJoin('historial', 'historial.idhistorial = (
  SELECT idhistorial FROM `historial` WHERE cliente_idcliente = cliente.idcliente ORDER BY idhistorial DESC LIMIT 1)');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['usuario'] = [
            'asc' => ['username' => SORT_ASC],
            'desc' => ['username' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['estado'] = [
            'asc' => ['estado_idestado' => SORT_ASC],
            'desc' => ['estado_idestado' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idcliente' => $this->idcliente,
            'nacimiento' => $this->nacimiento,
            'sexo_idsexo' => $this->sexo_idsexo,
            'usuario_idusuario' => $this->usuario_idusuario,
            'empleado_idempleado' => $this->empleado_idempleado,
            'estado_idestado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apaterno', $this->apaterno])
            ->andFilterWhere(['like', 'amaterno', $this->amaterno]);

        $query->andFilterWhere(['like', 'username', $this->usuario]);

        return $dataProvider;
    }
}
