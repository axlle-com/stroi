<?php

namespace common\models\Search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TagsHasItem;

/**
 * TagsHasItemSearch represents the model behind the search form about `common\models\TagsHasItem`.
 */
class TagsHasItemSearch extends TagsHasItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tags_id', 'item_id'], 'integer'],
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
        $query = TagsHasItem::find();

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
            'tags_id' => $this->tags_id,
            'item_id' => $this->item_id,
        ]);

        return $dataProvider;
    }
}
