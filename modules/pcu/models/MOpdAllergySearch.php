<?php

namespace app\modules\pcu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\pcu\models\MOpdAllergy;

/**
 * MOpdAllergySearch represents the model behind the search form of `app\modules\pcu\models\MOpdAllergy`.
 */
class MOpdAllergySearch extends MOpdAllergy {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['id','hn', 'report_date', 'agent', 'agent2','symptom', 'reporter', 'relation_level', 'note', 'allergy_type', 'begin_date', 'ward', 'department', 'spclty', 'entry_datetime', 'update_datetime', 'depcode', 'no_alert', 'force_no_order', 'hos_guid', 'preventable', 'patient_cid', 'hos_guid_ext', 'agent_code24', 'officer_confirm', 'icode', 'cross_group_check', 'doctor_code', 'dosage_text', 'usage_text', 'lab_text'], 'safe'],
                [['display_order', 'allergy_group_id', 'seriousness_id', 'allergy_result_id', 'allergy_relation_id', 'naranjo_result_id', 'opd_allergy_alert_type_id', 'adr_preventable_score', 'adr_consult_dialog_id', 'opd_allergy_report_type_id', 'opd_allergy_symtom_type_id', 'opd_allergy_id', 'opd_allergy_source_id', 'opd_allergy_type_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
      


     $model = OpdAllergy::find()->select(['concat(hn,agent)'])->asArray()
             ->all();


        $query = MOpdAllergy::find()
         //  ->asArray()
          ->where(['NOT IN', ['concat(hn,agent)'],$model])
          // ->asArray() 
                
        ;

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
            'report_date' => $this->report_date,
            'display_order' => $this->display_order,
            'begin_date' => $this->begin_date,
            'allergy_group_id' => $this->allergy_group_id,
            'seriousness_id' => $this->seriousness_id,
            'allergy_result_id' => $this->allergy_result_id,
            'allergy_relation_id' => $this->allergy_relation_id,
            'entry_datetime' => $this->entry_datetime,
            'update_datetime' => $this->update_datetime,
            'naranjo_result_id' => $this->naranjo_result_id,
            'opd_allergy_alert_type_id' => $this->opd_allergy_alert_type_id,
            'adr_preventable_score' => $this->adr_preventable_score,
            'adr_consult_dialog_id' => $this->adr_consult_dialog_id,
            'opd_allergy_report_type_id' => $this->opd_allergy_report_type_id,
            'opd_allergy_symtom_type_id' => $this->opd_allergy_symtom_type_id,
            'opd_allergy_id' => $this->opd_allergy_id,
            'opd_allergy_source_id' => $this->opd_allergy_source_id,
            'opd_allergy_type_id' => $this->opd_allergy_type_id,
        ]);

        $query
                ->andFilterWhere(['like', 'hn', $this->hn])
                ->andFilterWhere(['like', 'agent', $this->agent])
                ->andFilterWhere(['like', 'agent2', $this->agent2])
                ->andFilterWhere(['like', 'symptom', $this->symptom])
                ->andFilterWhere(['like', 'reporter', $this->reporter])
                ->andFilterWhere(['like', 'relation_level', $this->relation_level])
                ->andFilterWhere(['like', 'note', $this->note])
                ->andFilterWhere(['like', 'allergy_type', $this->allergy_type])
                ->andFilterWhere(['like', 'ward', $this->ward])
                ->andFilterWhere(['like', 'department', $this->department])
                ->andFilterWhere(['like', 'spclty', $this->spclty])
                ->andFilterWhere(['like', 'depcode', $this->depcode])
                ->andFilterWhere(['like', 'no_alert', $this->no_alert])
                ->andFilterWhere(['like', 'force_no_order', $this->force_no_order])
                ->andFilterWhere(['like', 'hos_guid', $this->hos_guid])
                ->andFilterWhere(['like', 'preventable', $this->preventable])
                ->andFilterWhere(['like', 'patient_cid', $this->patient_cid])
                ->andFilterWhere(['like', 'hos_guid_ext', $this->hos_guid_ext])
                ->andFilterWhere(['like', 'agent_code24', $this->agent_code24])
                ->andFilterWhere(['like', 'officer_confirm', $this->officer_confirm])
                ->andFilterWhere(['like', 'icode', $this->icode])
                ->andFilterWhere(['like', 'cross_group_check', $this->cross_group_check])
                ->andFilterWhere(['like', 'doctor_code', $this->doctor_code])
                ->andFilterWhere(['like', 'dosage_text', $this->dosage_text])
                ->andFilterWhere(['like', 'usage_text', $this->usage_text])
                ->andFilterWhere(['like', 'lab_text', $this->lab_text]);

        return $dataProvider;
    }

}
