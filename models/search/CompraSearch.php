<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Compra;

/**
 * CompraSearch represents the model behind the search form about `app\models\Compra`.
 */
class CompraSearch extends Compra
{
    public $provedor;
    public $empleado;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcompra', 'provedor_idprovedor', 'empleado_idempleado', 'estado_compra_idestado_compra'], 'integer'],
            [['fecha','provedor','empleado'], 'safe'],
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
        $query = Compra::find();
        $query->joinWith('provedorIdprovedor');
        $query->joinWith('empleadoIdempleado');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['empleado'] = [
            'asc' => ['empleado.nombre' => SORT_ASC],
            'desc' => ['empleado.nombre' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['provedor'] = [
            'asc' => ['provedor.nombre' => SORT_ASC],
            'desc' => ['provedor.nombre' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idcompra' => $this->idcompra,
            'fecha' => $this->fecha,
            'provedor_idprovedor' => $this->provedor_idprovedor,
            'empleado_idempleado' => $this->empleado_idempleado,
            'estado_compra_idestado_compra' => $this->estado_compra_idestado_compra,
            
        ]);
        $query->andFilterWhere(['like', 'provedor.nombre', $this->provedor]);
        $query->andFilterWhere(['like', 'empleado.nombre', $this->empleado]);
        
        return $dataProvider;
    }
}
