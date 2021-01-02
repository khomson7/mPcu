<?php

namespace app\modules\pcu\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\pcu\models\WscPcuOapp;

/**
 * WscPcuOappSearch represents the model behind the search form of `app\modules\pcu\models\WscPcuOapp`.
 */
class WscPcuOappSearch extends WscPcuOapp
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'result'], 'integer'],
            [['oaid','hospcode', 'date_app'], 'safe'],
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
        $query = WscPcuOapp::find();

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
            'oaid' => $this->oaid,
            'date_app' => $this->date_app,
            'result' => $this->result,
        ]);

        $query->andFilterWhere(['like', 'hospcode', $this->hospcode]);

        return $dataProvider;
    }
}
