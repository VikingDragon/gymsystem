<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Provedor;

/**
 * ProvedorSearch represents the model behind the search form about `app\models\Provedor`.
 */
class ProvedorSearch extends Provedor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idprovedor', 'estado_idestado'], 'integer'],
            [['nombre', 'telefono', 'direccion', 'nota', 'contacto'], 'safe'],
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
        $query = Provedor::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idprovedor' => $this->idprovedor,
            'estado_idestado' => $this->estado_idestado,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'nota', $this->nota])
            ->andFilterWhere(['like', 'contacto', $this->contacto]);

        return $dataProvider;
    }
}
