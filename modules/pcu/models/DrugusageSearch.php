<?php

namespace app\modules\pcu\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\pcu\models\Drugusage;

/**
 * DrugusageSearch represents the model behind the search form of `app\modules\pcu\models\Drugusage`.
 */
class DrugusageSearch extends Drugusage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['drugusage', 'code', 'name1', 'name2', 'name3', 'shortlist', 'idrlink', 'status', 'interval1', 'interval2', 'interval3', 'interval4', 'interval5', 'interval6', 'dosageform', 'ename1', 'ename2', 'ename3', 'drugusage_guid', 'common_name', 'drugusage_active', 'opi_usage_code', 'opi_unit_name', 'opi_frequency_code', 'opi_usage_unit_code', 'opi_time_code', 'hos_guid', 'hos_guid_ext', 'no_disp_machine', 'use_opi_mode2', 'doctor_use'], 'safe'],
            [['iperday', 'divide_amount', 'opi_acpc_id', 'ipt_injection_sticker_count', 'display_order'], 'integer'],
            [['iperdose', 'opi_dose'], 'number'],
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
        $query = Drugusage::find();

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
            'iperday' => $this->iperday,
            'iperdose' => $this->iperdose,
            'divide_amount' => $this->divide_amount,
            'opi_acpc_id' => $this->opi_acpc_id,
            'opi_dose' => $this->opi_dose,
            'ipt_injection_sticker_count' => $this->ipt_injection_sticker_count,
            'display_order' => $this->display_order,
        ]);

        $query->andFilterWhere(['like', 'drugusage', $this->drugusage])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name1', $this->name1])
            ->andFilterWhere(['like', 'name2', $this->name2])
            ->andFilterWhere(['like', 'name3', $this->name3])
            ->andFilterWhere(['like', 'shortlist', $this->shortlist])
            ->andFilterWhere(['like', 'idrlink', $this->idrlink])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'interval1', $this->interval1])
            ->andFilterWhere(['like', 'interval2', $this->interval2])
            ->andFilterWhere(['like', 'interval3', $this->interval3])
            ->andFilterWhere(['like', 'interval4', $this->interval4])
            ->andFilterWhere(['like', 'interval5', $this->interval5])
            ->andFilterWhere(['like', 'interval6', $this->interval6])
            ->andFilterWhere(['like', 'dosageform', $this->dosageform])
            ->andFilterWhere(['like', 'ename1', $this->ename1])
            ->andFilterWhere(['like', 'ename2', $this->ename2])
            ->andFilterWhere(['like', 'ename3', $this->ename3])
            ->andFilterWhere(['like', 'drugusage_guid', $this->drugusage_guid])
            ->andFilterWhere(['like', 'common_name', $this->common_name])
            ->andFilterWhere(['like', 'drugusage_active', $this->drugusage_active])
            ->andFilterWhere(['like', 'opi_usage_code', $this->opi_usage_code])
            ->andFilterWhere(['like', 'opi_unit_name', $this->opi_unit_name])
            ->andFilterWhere(['like', 'opi_frequency_code', $this->opi_frequency_code])
            ->andFilterWhere(['like', 'opi_usage_unit_code', $this->opi_usage_unit_code])
            ->andFilterWhere(['like', 'opi_time_code', $this->opi_time_code])
            ->andFilterWhere(['like', 'hos_guid', $this->hos_guid])
            ->andFilterWhere(['like', 'hos_guid_ext', $this->hos_guid_ext])
            ->andFilterWhere(['like', 'no_disp_machine', $this->no_disp_machine])
            ->andFilterWhere(['like', 'use_opi_mode2', $this->use_opi_mode2])
            ->andFilterWhere(['like', 'doctor_use', $this->doctor_use]);

        return $dataProvider;
    }
}
