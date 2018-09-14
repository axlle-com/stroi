<?php

namespace common\models\Search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Item;

/**
 * ItemSearch represents the model behind the search form about `common\models\Item`.
 */
class ItemSearch extends Item
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'render_id', 'sitemap', 'published', 'favourites', 'show_comments', 'show_img', 'show_img_post', 'show_img_cat', 'show_message', 'show_data', 'watermark', 'small_img', 'tumb_img', 'created_at', 'updated_at', 'position', 'hits'], 'integer'],
            [['media', 'alias_item', 'title', 'title_seo', 'title_short', 'description_seo', 'description', 'purified_text', 'date_pub', 'date_end', 'general_photo'], 'safe'],
            [['stars'], 'number'],
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
        $query = Item::find()->with(['category']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'forcePageParam' => false,
                'pageSizeParam' => false,
                'pageSize' => 70
            ]
        ]);
        //$dataProvider->pagination = false;
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
            'render_id' => $this->render_id,
            'sitemap' => $this->sitemap,
            'published' => $this->published,
            'favourites' => $this->favourites,
            'show_comments' => $this->show_comments,
            'show_img' => $this->show_img,
            'show_img_post' => $this->show_img_post,
            'show_img_cat' => $this->show_img_cat,
            'show_message' => $this->show_message,
            'show_data' => $this->show_data,
            'watermark' => $this->watermark,
            'small_img' => $this->small_img,
            'tumb_img' => $this->tumb_img,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'date_pub' => $this->date_pub,
            'date_end' => $this->date_end,
            'position' => $this->position,
            'hits' => $this->hits,
            'stars' => $this->stars,
        ]);

        $query->andFilterWhere(['like', 'media', $this->media])
            ->andFilterWhere(['like', 'alias_item', $this->alias_item])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title_seo', $this->title_seo])
            ->andFilterWhere(['like', 'title_short', $this->title_short])
            ->andFilterWhere(['like', 'description_seo', $this->description_seo])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'purified_text', $this->purified_text])
            ->andFilterWhere(['like', 'general_photo', $this->general_photo]);

        return $dataProvider;
    }
}
