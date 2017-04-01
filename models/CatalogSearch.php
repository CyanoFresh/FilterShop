<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;
use yii\db\ActiveQuery;
use yii\helpers\VarDumper;

/**
 * ProductSearch represents the model behind the search form about `app\models\Product`.
 */
class CatalogSearch extends Product
{
    public $parameters;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parameters'], 'safe'],
        ];
    }

    public function formName()
    {
        return '';
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
     * @param ActiveQuery|null $query
     * @return ActiveDataProvider
     */
    public function search($params, $query = null)
    {
        if ($query == null) {
            $query = Product::find();
        }

        // add conditions that should always apply here
        $query->joinWith(['productParameters']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        echo '<br>';
        echo '<br>';
        echo '<br>';

        VarDumper::dump($this->parameters, 10,true);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        if ($this->parameters) {
            foreach ($this->parameters as $parameterValues) {
                foreach ($parameterValues as $parameterValue) {
                    $query->andFilterWhere([
                        'product_parameter.value' => $parameterValue,
                    ]);
                }
            }
        }

        return $dataProvider;
    }
}
