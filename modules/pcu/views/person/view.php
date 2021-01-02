<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\Person */

$this->title = $model->person_id;
$this->params['breadcrumbs'][] = ['label' => 'People', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="person-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->person_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->person_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'person_id',
            'house_id',
            'cid',
            'pname',
            'fname',
            'lname',
            'pcode',
            'sex',
            'nationality',
            'citizenship',
            'education',
            'occupation',
            'religion',
            'marrystatus',
            'house_regist_type_id',
            'birthdate',
            'has_house_regist',
            'chronic_disease_list',
            'club_list',
            'village_id',
            'blood_group',
            'current_age',
            'death_date',
            'hos_guid',
            'income_per_year',
            'home_position_id',
            'family_position_id',
            'drug_allergy',
            'last_update',
            'death',
            'pttype',
            'pttype_begin_date',
            'pttype_expire_date',
            'pttype_hospmain',
            'pttype_hospsub',
            'father_person_id',
            'mother_person_id',
            'pttype_no',
            'sps_person_id',
            'birthtime',
            'age_y',
            'age_m',
            'age_d',
            'family_id',
            'person_house_position_id',
            'couple_person_id',
            'person_guid',
            'house_guid',
            'last_update_pttype',
            'patient_link',
            'patient_hn',
            'found_dw_emr',
            'person_discharge_id',
            'movein_date',
            'discharge_date',
            'person_labor_type_id',
            'father_name',
            'mother_name',
            'sps_name',
            'father_cid',
            'mother_cid',
            'sps_cid',
            'bloodgroup_rh',
            'home_phone',
            'old_code',
            'deformed_status',
            'ncd_dm_history_type_id',
            'ncd_ht_history_type_id',
            'agriculture_member_type_id',
            'senile',
            'in_region',
            'body_weight_kg',
            'height_cm',
            'nutrition_level',
            'height_nutrition_level',
            'bw_ht_nutrition_level',
            'hometel',
            'worktel',
            'register_conflict',
            'care_person_name',
            'work_addr',
            'person_dm_screen_status_id',
            'person_ht_screen_status_id',
            'person_stroke_screen_status_id',
            'person_obesity_screen_status_id',
            'person_dmht_manage_type_id',
            'last_screen_dmht_bdg_year',
            'dw_chronic_register',
            'mobile_phone',
            'kcheck',
          //  'pttype_nhso_valid',
         //   'pttype_nhso_valid_datetime',
        ],
    ]) ?>

</div>
