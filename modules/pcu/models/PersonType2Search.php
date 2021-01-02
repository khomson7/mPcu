<?php

namespace app\modules\pcu\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\pcu\models\Person;

/**
 * PersonSearch represents the model behind the search form of `app\modules\pcu\models\Person`.
 */
class PersonType2Search extends Person
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['person_id', 'house_id', 'house_regist_type_id', 'village_id', 'current_age', 'income_per_year', 'home_position_id', 'family_position_id', 'father_person_id', 'mother_person_id', 'sps_person_id', 'age_y', 'age_m', 'age_d', 'family_id', 'person_house_position_id', 'couple_person_id', 'person_discharge_id', 'person_labor_type_id', 'ncd_dm_history_type_id', 'ncd_ht_history_type_id', 'agriculture_member_type_id', 'nutrition_level', 'height_nutrition_level', 'bw_ht_nutrition_level', 'person_dm_screen_status_id', 'person_ht_screen_status_id', 'person_stroke_screen_status_id', 'person_obesity_screen_status_id', 'person_dmht_manage_type_id', 'last_screen_dmht_bdg_year'], 'integer'],
            [['cid', 'pname', 'fname', 'lname', 'pcode', 'sex', 'nationality', 'citizenship', 'education', 'occupation', 'religion', 'marrystatus', 'birthdate', 'has_house_regist', 'chronic_disease_list', 'club_list', 'blood_group', 'death_date', 'hos_guid', 'drug_allergy', 'last_update', 'death', 'pttype', 'pttype_begin_date', 'pttype_expire_date', 'pttype_hospmain', 'pttype_hospsub', 'pttype_no', 'birthtime', 'person_guid', 'house_guid', 'last_update_pttype', 'patient_link', 'patient_hn', 'found_dw_emr', 'movein_date', 'discharge_date', 'father_name', 'mother_name', 'sps_name', 'father_cid', 'mother_cid', 'sps_cid', 'bloodgroup_rh', 'home_phone', 'old_code', 'deformed_status', 'senile', 'in_region', 'hometel', 'worktel', 'register_conflict', 'care_person_name', 'work_addr', 'dw_chronic_register', 'mobile_phone', 'kcheck', 'pttype_nhso_valid', 'pttype_nhso_valid_datetime'], 'safe'],
            [['body_weight_kg', 'height_cm'], 'number'],
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
        $query = Person::find()
                ->where('house_regist_type_id= :house_regist_type_id', [':house_regist_type_id' => '2'])
                 ->andWhere(['NOT IN', 'person_discharge_id', '1'])
                ->orderBy(['last_update' => SORT_ASC])
                ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
              'pagination' => [
        'pageSize' => 100,
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
            'person_id' => $this->person_id,
            'house_id' => $this->house_id,
            'house_regist_type_id' => $this->house_regist_type_id,
            'birthdate' => $this->birthdate,
            'village_id' => $this->village_id,
            'current_age' => $this->current_age,
            'death_date' => $this->death_date,
            'income_per_year' => $this->income_per_year,
            'home_position_id' => $this->home_position_id,
            'family_position_id' => $this->family_position_id,
            'last_update' => $this->last_update,
            'pttype_begin_date' => $this->pttype_begin_date,
            'pttype_expire_date' => $this->pttype_expire_date,
            'father_person_id' => $this->father_person_id,
            'mother_person_id' => $this->mother_person_id,
            'sps_person_id' => $this->sps_person_id,
            'birthtime' => $this->birthtime,
            'age_y' => $this->age_y,
            'age_m' => $this->age_m,
            'age_d' => $this->age_d,
            'family_id' => $this->family_id,
            'person_house_position_id' => $this->person_house_position_id,
            'couple_person_id' => $this->couple_person_id,
            'last_update_pttype' => $this->last_update_pttype,
            'person_discharge_id' => $this->person_discharge_id,
            'movein_date' => $this->movein_date,
            'discharge_date' => $this->discharge_date,
            'person_labor_type_id' => $this->person_labor_type_id,
            'ncd_dm_history_type_id' => $this->ncd_dm_history_type_id,
            'ncd_ht_history_type_id' => $this->ncd_ht_history_type_id,
            'agriculture_member_type_id' => $this->agriculture_member_type_id,
            'body_weight_kg' => $this->body_weight_kg,
            'height_cm' => $this->height_cm,
            'nutrition_level' => $this->nutrition_level,
            'height_nutrition_level' => $this->height_nutrition_level,
            'bw_ht_nutrition_level' => $this->bw_ht_nutrition_level,
            'person_dm_screen_status_id' => $this->person_dm_screen_status_id,
            'person_ht_screen_status_id' => $this->person_ht_screen_status_id,
            'person_stroke_screen_status_id' => $this->person_stroke_screen_status_id,
            'person_obesity_screen_status_id' => $this->person_obesity_screen_status_id,
            'person_dmht_manage_type_id' => $this->person_dmht_manage_type_id,
            'last_screen_dmht_bdg_year' => $this->last_screen_dmht_bdg_year,
           // 'pttype_nhso_valid_datetime' => $this->pttype_nhso_valid_datetime,
        ]);

        $query->andFilterWhere(['like', 'cid', $this->cid])
            ->andFilterWhere(['like', 'pname', $this->pname])
            ->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'lname', $this->lname])
            ->andFilterWhere(['like', 'pcode', $this->pcode])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'citizenship', $this->citizenship])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'occupation', $this->occupation])
            ->andFilterWhere(['like', 'religion', $this->religion])
            ->andFilterWhere(['like', 'marrystatus', $this->marrystatus])
            ->andFilterWhere(['like', 'has_house_regist', $this->has_house_regist])
            ->andFilterWhere(['like', 'chronic_disease_list', $this->chronic_disease_list])
            ->andFilterWhere(['like', 'club_list', $this->club_list])
            ->andFilterWhere(['like', 'blood_group', $this->blood_group])
            ->andFilterWhere(['like', 'hos_guid', $this->hos_guid])
            ->andFilterWhere(['like', 'drug_allergy', $this->drug_allergy])
            ->andFilterWhere(['like', 'death', $this->death])
            ->andFilterWhere(['like', 'pttype', $this->pttype])
            ->andFilterWhere(['like', 'pttype_hospmain', $this->pttype_hospmain])
            ->andFilterWhere(['like', 'pttype_hospsub', $this->pttype_hospsub])
            ->andFilterWhere(['like', 'pttype_no', $this->pttype_no])
            ->andFilterWhere(['like', 'person_guid', $this->person_guid])
            ->andFilterWhere(['like', 'house_guid', $this->house_guid])
            ->andFilterWhere(['like', 'patient_link', $this->patient_link])
            ->andFilterWhere(['like', 'patient_hn', $this->patient_hn])
            ->andFilterWhere(['like', 'found_dw_emr', $this->found_dw_emr])
            ->andFilterWhere(['like', 'father_name', $this->father_name])
            ->andFilterWhere(['like', 'mother_name', $this->mother_name])
            ->andFilterWhere(['like', 'sps_name', $this->sps_name])
            ->andFilterWhere(['like', 'father_cid', $this->father_cid])
            ->andFilterWhere(['like', 'mother_cid', $this->mother_cid])
            ->andFilterWhere(['like', 'sps_cid', $this->sps_cid])
            ->andFilterWhere(['like', 'bloodgroup_rh', $this->bloodgroup_rh])
            ->andFilterWhere(['like', 'home_phone', $this->home_phone])
            ->andFilterWhere(['like', 'old_code', $this->old_code])
            ->andFilterWhere(['like', 'deformed_status', $this->deformed_status])
            ->andFilterWhere(['like', 'senile', $this->senile])
            ->andFilterWhere(['like', 'in_region', $this->in_region])
            ->andFilterWhere(['like', 'hometel', $this->hometel])
            ->andFilterWhere(['like', 'worktel', $this->worktel])
            ->andFilterWhere(['like', 'register_conflict', $this->register_conflict])
            ->andFilterWhere(['like', 'care_person_name', $this->care_person_name])
            ->andFilterWhere(['like', 'work_addr', $this->work_addr])
            ->andFilterWhere(['like', 'dw_chronic_register', $this->dw_chronic_register])
            ->andFilterWhere(['like', 'mobile_phone', $this->mobile_phone])
            ->andFilterWhere(['like', 'kcheck', $this->kcheck]);
          //  ->andFilterWhere(['like', 'pttype_nhso_valid', $this->pttype_nhso_valid]);

        return $dataProvider;
    }
}
