<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Membrecia;

/**
 * MembreciaSearch represents the model behind the search form about `app\models\Membrecia`.
 */
class MembreciaSearch extends Membrecia
{
    /**
     * @inheritdoc
     */
    public $nombre;
    public $precio;
    public function rules()
    {
        return [
            [['inventario_idinventario', 'personas', 'estado_idestado'], 'integer'],
            [['inicio', 'fin', 'nombre', 'precio'], 'safe'],
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
        $query = Membrecia::find();
        $query->joinWith('inventarioIdinventario');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['nombre'] = [
            'asc' => ['nombre' => SORT_ASC],
            'desc' => ['nombre' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['precio'] = [
            'asc' => ['precio' => SORT_ASC],
            'desc' => ['precio' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'inventario_idinventario' => $this->inventario_idinventario,
            'personas' => $this->personas,
            'inicio' => $this->inicio,
            'fin' => $this->fin,
            'estado_idestado' => $this->estado_idestado,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre]);
        $query->andFilterWhere(['like', 'precio', $this->precio]);

        return $dataProvider;
    }
}
