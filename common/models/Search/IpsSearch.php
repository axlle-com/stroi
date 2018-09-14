<?php

namespace common\models\Search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Ips;

/**
 * IpsSearch represents the model behind the search form about `common\models\Ips`.
 */
class IpsSearch extends Ips
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'black', 'block'], 'integer'],
            [['host', 'person', 'phone', 'email', 'description'], 'safe'],
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
        $query = Ips::find();

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
            'black' => $this->black,
            'block' => $this->block,
        ]);

        $query->andFilterWhere(['like', 'host', $this->host])
            ->andFilterWhere(['like', 'person', $this->person])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
