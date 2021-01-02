<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\PersonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'person_id') ?>

    <?= $form->field($model, 'house_id') ?>

    <?= $form->field($model, 'cid') ?>

    <?= $form->field($model, 'pname') ?>

    <?= $form->field($model, 'fname') ?>

    <?php // echo $form->field($model, 'lname') ?>

    <?php // echo $form->field($model, 'pcode') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'nationality') ?>

    <?php // echo $form->field($model, 'citizenship') ?>

    <?php // echo $form->field($model, 'education') ?>

    <?php // echo $form->field($model, 'occupation') ?>

    <?php // echo $form->field($model, 'religion') ?>

    <?php // echo $form->field($model, 'marrystatus') ?>

    <?php // echo $form->field($model, 'house_regist_type_id') ?>

    <?php // echo $form->field($model, 'birthdate') ?>

    <?php // echo $form->field($model, 'has_house_regist') ?>

    <?php // echo $form->field($model, 'chronic_disease_list') ?>

    <?php // echo $form->field($model, 'club_list') ?>

    <?php // echo $form->field($model, 'village_id') ?>

    <?php // echo $form->field($model, 'blood_group') ?>

    <?php // echo $form->field($model, 'current_age') ?>

    <?php // echo $form->field($model, 'death_date') ?>

    <?php // echo $form->field($model, 'hos_guid') ?>

    <?php // echo $form->field($model, 'income_per_year') ?>

    <?php // echo $form->field($model, 'home_position_id') ?>

    <?php // echo $form->field($model, 'family_position_id') ?>

    <?php // echo $form->field($model, 'drug_allergy') ?>

    <?php // echo $form->field($model, 'last_update') ?>

    <?php // echo $form->field($model, 'death') ?>

    <?php // echo $form->field($model, 'pttype') ?>

    <?php // echo $form->field($model, 'pttype_begin_date') ?>

    <?php // echo $form->field($model, 'pttype_expire_date') ?>

    <?php // echo $form->field($model, 'pttype_hospmain') ?>

    <?php // echo $form->field($model, 'pttype_hospsub') ?>

    <?php // echo $form->field($model, 'father_person_id') ?>

    <?php // echo $form->field($model, 'mother_person_id') ?>

    <?php // echo $form->field($model, 'pttype_no') ?>

    <?php // echo $form->field($model, 'sps_person_id') ?>

    <?php // echo $form->field($model, 'birthtime') ?>

    <?php // echo $form->field($model, 'age_y') ?>

    <?php // echo $form->field($model, 'age_m') ?>

    <?php // echo $form->field($model, 'age_d') ?>

    <?php // echo $form->field($model, 'family_id') ?>

    <?php // echo $form->field($model, 'person_house_position_id') ?>

    <?php // echo $form->field($model, 'couple_person_id') ?>

    <?php // echo $form->field($model, 'person_guid') ?>

    <?php // echo $form->field($model, 'house_guid') ?>

    <?php // echo $form->field($model, 'last_update_pttype') ?>

    <?php // echo $form->field($model, 'patient_link') ?>

    <?php // echo $form->field($model, 'patient_hn') ?>

    <?php // echo $form->field($model, 'found_dw_emr') ?>

    <?php // echo $form->field($model, 'person_discharge_id') ?>

    <?php // echo $form->field($model, 'movein_date') ?>

    <?php // echo $form->field($model, 'discharge_date') ?>

    <?php // echo $form->field($model, 'person_labor_type_id') ?>

    <?php // echo $form->field($model, 'father_name') ?>

    <?php // echo $form->field($model, 'mother_name') ?>

    <?php // echo $form->field($model, 'sps_name') ?>

    <?php // echo $form->field($model, 'father_cid') ?>

    <?php // echo $form->field($model, 'mother_cid') ?>

    <?php // echo $form->field($model, 'sps_cid') ?>

    <?php // echo $form->field($model, 'bloodgroup_rh') ?>

    <?php // echo $form->field($model, 'home_phone') ?>

    <?php // echo $form->field($model, 'old_code') ?>

    <?php // echo $form->field($model, 'deformed_status') ?>

    <?php // echo $form->field($model, 'ncd_dm_history_type_id') ?>

    <?php // echo $form->field($model, 'ncd_ht_history_type_id') ?>

    <?php // echo $form->field($model, 'agriculture_member_type_id') ?>

    <?php // echo $form->field($model, 'senile') ?>

    <?php // echo $form->field($model, 'in_region') ?>

    <?php // echo $form->field($model, 'body_weight_kg') ?>

    <?php // echo $form->field($model, 'height_cm') ?>

    <?php // echo $form->field($model, 'nutrition_level') ?>

    <?php // echo $form->field($model, 'height_nutrition_level') ?>

    <?php // echo $form->field($model, 'bw_ht_nutrition_level') ?>

    <?php // echo $form->field($model, 'hometel') ?>

    <?php // echo $form->field($model, 'worktel') ?>

    <?php // echo $form->field($model, 'register_conflict') ?>

    <?php // echo $form->field($model, 'care_person_name') ?>

    <?php // echo $form->field($model, 'work_addr') ?>

    <?php // echo $form->field($model, 'person_dm_screen_status_id') ?>

    <?php // echo $form->field($model, 'person_ht_screen_status_id') ?>

    <?php // echo $form->field($model, 'person_stroke_screen_status_id') ?>

    <?php // echo $form->field($model, 'person_obesity_screen_status_id') ?>

    <?php // echo $form->field($model, 'person_dmht_manage_type_id') ?>

    <?php // echo $form->field($model, 'last_screen_dmht_bdg_year') ?>

    <?php // echo $form->field($model, 'dw_chronic_register') ?>

    <?php // echo $form->field($model, 'mobile_phone') ?>

    <?php // echo $form->field($model, 'kcheck') ?>

    <?php // echo $form->field($model, 'pttype_nhso_valid') ?>

    <?php // echo $form->field($model, 'pttype_nhso_valid_datetime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
