<?php

namespace common\models\Search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Details;

/**
 * DetailsSearch represents the model behind the search form about `common\models\Details`.
 */
class DetailsSearch extends Details
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'item_id', 'room', 'floor', 'mansard', 'balcony', 'krilco', 'garage', 'erker', 'dacha', 'original_price', 'time_build'], 'integer'],
            [['name', 'same_item', 'material', 'initial_size', 'square'], 'safe'],
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
        $query = Details::find();

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
            'id' => $this->id,
            'item_id' => $this->item_id,
            'room' => $this->room,
            'floor' => $this->floor,
            'mansard' => $this->mansard,
            'balcony' => $this->balcony,
            'krilco' => $this->krilco,
            'garage' => $this->garage,
            'erker' => $this->erker,
            'dacha' => $this->dacha,
            'original_price' => $this->original_price,
            'time_build' => $this->time_build,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'same_item', $this->same_item])
            ->andFilterWhere(['like', 'material', $this->material])
            ->andFilterWhere(['like', 'initial_size', $this->initial_size])
            ->andFilterWhere(['like', 'square', $this->square]);

        return $dataProvider;
    }
}
