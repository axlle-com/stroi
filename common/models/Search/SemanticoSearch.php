<?php

namespace common\models\Search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Semantico;

/**
 * SemanticoSearch represents the model behind the search form about `common\models\Semantico`.
 */
class SemanticoSearch extends Semantico
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'item_id', 'key_name'], 'integer'],
            [['title', 'title_seo', 'description', 'description_seo'], 'safe'],
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
        $query = Semantico::find();

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
            'item_id' => $this->item_id,
            'key_name' => $this->key_name,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title_seo', $this->title_seo])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'description_seo', $this->description_seo]);

        return $dataProvider;
    }
}
