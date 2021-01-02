<?php

namespace app\modules\pcu\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\pcu\models\MDttm;

/**
 * MDttmSearch represents the model behind the search form of `app\modules\pcu\models\MDttm`.
 */
class MDttmSearch extends MDttm
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'requiredtc', 'treatment', 'icd10', 'icd9cm', 'icode', 'unit', 'charge_per_qty', 'active_status', 'dttm_guid', 'thai_name', 'charge_area_qty', 'icd10tm_operation_code', 'export_proced', 'dent2006_item_code', 'hos_guid'], 'safe'],
            [['vorder', 'dttm_group_id', 'dttm_subgroup_id', 'dttm_dw_report_group_id'], 'integer'],
            [['opd_price1', 'opd_price2', 'opd_price3', 'ipd_price1', 'ipd_price2', 'ipd_price3'], 'number'],
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
        
             $model = Dttm::find()->select('code')
                 // ->where(['IS','provis_labcode',$provislab])
                ->all();
        

        
        $query = MDttm::find()
                ->where(['NOT IN', 'code', $model]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
//                'approve'=> 'SORT_ASC',

                    'code' => 'SORT_DESC',
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'vorder' => $this->vorder,
            'opd_price1' => $this->opd_price1,
            'opd_price2' => $this->opd_price2,
            'opd_price3' => $this->opd_price3,
            'ipd_price1' => $this->ipd_price1,
            'ipd_price2' => $this->ipd_price2,
            'ipd_price3' => $this->ipd_price3,
            'dttm_group_id' => $this->dttm_group_id,
            'dttm_subgroup_id' => $this->dttm_subgroup_id,
            'dttm_dw_report_group_id' => $this->dttm_dw_report_group_id,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'requiredtc', $this->requiredtc])
            ->andFilterWhere(['like', 'treatment', $this->treatment])
            ->andFilterWhere(['like', 'icd10', $this->icd10])
            ->andFilterWhere(['like', 'icd9cm', $this->icd9cm])
            ->andFilterWhere(['like', 'icode', $this->icode])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'charge_per_qty', $this->charge_per_qty])
            ->andFilterWhere(['like', 'active_status', $this->active_status])
            ->andFilterWhere(['like', 'dttm_guid', $this->dttm_guid])
            ->andFilterWhere(['like', 'thai_name', $this->thai_name])
            ->andFilterWhere(['like', 'charge_area_qty', $this->charge_area_qty])
            ->andFilterWhere(['like', 'icd10tm_operation_code', $this->icd10tm_operation_code])
            ->andFilterWhere(['like', 'export_proced', $this->export_proced])
            ->andFilterWhere(['like', 'dent2006_item_code', $this->dent2006_item_code])
            ->andFilterWhere(['like', 'hos_guid', $this->hos_guid]);

        return $dataProvider;
    }
}
