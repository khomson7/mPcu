<?php

namespace app\modules\pcu\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\pcu\models\MWbcVaccine;

/**
 * MWbcVaccineSearch represents the model behind the search form of `app\modules\pcu\models\MWbcVaccine`.
 */
class MWbcVaccineSearch extends MWbcVaccine
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wbc_vaccine_id', 'age_min', 'age_max'], 'integer'],
            [['wbc_vaccine_name', 'wbc_vaccine_code', 'export_vaccine_code', 'check_code', 'vaccine_in_use', 'hos_guid', 'icode', 'combine_vaccine'], 'safe'],
            [['price'], 'number'],
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
          $model = \app\modules\pcu\models\WbcVaccine::find()->select('wbc_vaccine_code')
                ->all();
        $query = MWbcVaccine::find()
                ->where(['NOT IN', 'wbc_vaccine_code', $model]);
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
            'wbc_vaccine_id' => $this->wbc_vaccine_id,
            'age_min' => $this->age_min,
            'age_max' => $this->age_max,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'wbc_vaccine_name', $this->wbc_vaccine_name])
            ->andFilterWhere(['like', 'wbc_vaccine_code', $this->wbc_vaccine_code])
            ->andFilterWhere(['like', 'export_vaccine_code', $this->export_vaccine_code])
            ->andFilterWhere(['like', 'check_code', $this->check_code])
            ->andFilterWhere(['like', 'vaccine_in_use', $this->vaccine_in_use])
            ->andFilterWhere(['like', 'hos_guid', $this->hos_guid])
            ->andFilterWhere(['like', 'icode', $this->icode])
            ->andFilterWhere(['like', 'combine_vaccine', $this->combine_vaccine]);

        return $dataProvider;
    }
}
