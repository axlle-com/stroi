<?php

namespace common\models\Search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Reviews;

/**
 * ReviewsSearch represents the model behind the search form about `common\models\Reviews`.
 */
class ReviewsSearch extends Reviews
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'positively', 'show_img', 'watermark', 'small_img', 'tumb_img'], 'integer'],
            [['data', 'place', 'name', 'title', 'description', 'media', 'general_photo', 'data_rev', 'name_rev', 'title_rev', 'description_rev'], 'safe'],
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
        $query = Reviews::find();

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
            'category_id' => $this->category_id,
            'data' => $this->data,
            'positively' => $this->positively,
            'show_img' => $this->show_img,
            'watermark' => $this->watermark,
            'small_img' => $this->small_img,
            'tumb_img' => $this->tumb_img,
            'data_rev' => $this->data_rev,
        ]);

        $query->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'media', $this->media])
            ->andFilterWhere(['like', 'general_photo', $this->general_photo])
            ->andFilterWhere(['like', 'name_rev', $this->name_rev])
            ->andFilterWhere(['like', 'title_rev', $this->title_rev])
            ->andFilterWhere(['like', 'description_rev', $this->description_rev]);

        return $dataProvider;
    }
}
