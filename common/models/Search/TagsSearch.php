<?php

namespace common\models\Search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tags;

/**
 * TagsSearch represents the model behind the search form about `common\models\Tags`.
 */
class TagsSearch extends Tags
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sitemap'], 'integer'],
            [['alias_category', 'alias_tags', 'title', 'title_short', 'title_seo', 'description_seo', 'description', 'name', 'type'], 'safe'],
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
        $query = Tags::find();

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
            'sitemap' => $this->sitemap,
        ]);

        $query->andFilterWhere(['like', 'alias_category', $this->alias_category])
            ->andFilterWhere(['like', 'alias_tags', $this->alias_tags])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title_short', $this->title_short])
            ->andFilterWhere(['like', 'title_seo', $this->title_seo])
            ->andFilterWhere(['like', 'description_seo', $this->description_seo])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
