<?php

namespace common\models\Search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Category;

/**
 * CategorySearch represents the model behind the search form about `common\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'render_id', 'parent_id', 'sitemap', 'published', 'favourites', 'show_img', 'watermark', 'small_img', 'tumb_img', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['alias_category', 'title', 'title_seo', 'title_short', 'description', 'description_seo', 'purified_text', 'general_photo'], 'safe'],
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
        $query = Category::find();

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
            'render_id' => $this->render_id,
            'parent_id' => $this->parent_id,
            'sitemap' => $this->sitemap,
            'published' => $this->published,
            'favourites' => $this->favourites,
            'show_img' => $this->show_img,
            'watermark' => $this->watermark,
            'small_img' => $this->small_img,
            'tumb_img' => $this->tumb_img,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'alias_category', $this->alias_category])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title_seo', $this->title_seo])
            ->andFilterWhere(['like', 'title_short', $this->title_short])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'description_seo', $this->description_seo])
            ->andFilterWhere(['like', 'purified_text', $this->purified_text])
            ->andFilterWhere(['like', 'general_photo', $this->general_photo]);

        return $dataProvider;
    }
}
