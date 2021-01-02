<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HosBasedata;

/**
 * HosBasedataSearch represents the model behind the search form of `app\models\HosBasedata`.
 */
class HosBasedataSearch extends HosBasedata
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'count_report'], 'integer'],
            [['base_data', 'detail', 'link', 'active'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = HosBasedata::find();

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
            'count_report' => $this->count_report,
        ]);

        $query->andFilterWhere(['like', 'base_data', $this->base_data])
            ->andFilterWhere(['like', 'detail', $this->detail])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'active', $this->active]);

        return $dataProvider;
    }
}
