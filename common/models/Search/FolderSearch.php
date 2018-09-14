<?php

namespace common\models\Search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Folder;

/**
 * FolderSearch represents the model behind the search form about `common\models\Folder`.
 */
class FolderSearch extends Folder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'show_img', 'watermark', 'small_img', 'tumb_img'], 'integer'],
            [['title', 'description', 'link', 'general_photo'], 'safe'],
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
        $query = Folder::find();

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
            'show_img' => $this->show_img,
            'watermark' => $this->watermark,
            'small_img' => $this->small_img,
            'tumb_img' => $this->tumb_img,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'general_photo', $this->general_photo]);

        return $dataProvider;
    }
}
