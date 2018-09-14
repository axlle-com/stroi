<?php

namespace common\models\Search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TypeHasSpecifically;

/**
 * TypeHasSpecificallySearch represents the model behind the search form about `common\models\TypeHasSpecifically`.
 */
class TypeHasSpecificallySearch extends TypeHasSpecifically
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'specifically_id'], 'integer'],
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
        $query = TypeHasSpecifically::find();

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
            'type_id' => $this->type_id,
            'specifically_id' => $this->specifically_id,
        ]);

        return $dataProvider;
    }
}
