<?php

namespace common\models\Search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Infoblock;

/**
 * InfoblockSearch represents the model behind the search form about `common\models\Infoblock`.
 */
class InfoblockSearch extends Infoblock
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'published', 'favourites', 'show_img', 'watermark', 'small_img', 'tumb_img', 'created_at', 'updated_at'], 'integer'],
            [['name', 'title', 'description', 'purified_text', 'date_pub', 'date_end', 'general_photo'], 'safe'],
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
        $query = Infoblock::find();

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
            'published' => $this->published,
            'favourites' => $this->favourites,
            'show_img' => $this->show_img,
            'watermark' => $this->watermark,
            'small_img' => $this->small_img,
            'tumb_img' => $this->tumb_img,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'date_pub' => $this->date_pub,
            'date_end' => $this->date_end,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'purified_text', $this->purified_text])
            ->andFilterWhere(['like', 'general_photo', $this->general_photo]);

        return $dataProvider;
    }
}
