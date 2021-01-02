<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\Person */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'person_id')->textInput() ?>

    <?= $form->field($model, 'house_id')->textInput() ?>

    <?= $form->field($model, 'cid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nationality')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'citizenship')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'education')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'occupation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'religion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marrystatus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'house_regist_type_id')->textInput() ?>

    <?= $form->field($model, 'birthdate')->textInput() ?>

    <?= $form->field($model, 'has_house_regist')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chronic_disease_list')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'club_list')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'village_id')->textInput() ?>

    <?= $form->field($model, 'blood_group')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'current_age')->textInput() ?>

    <?= $form->field($model, 'death_date')->textInput() ?>

    <?= $form->field($model, 'hos_guid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'income_per_year')->textInput() ?>

    <?= $form->field($model, 'home_position_id')->textInput() ?>

    <?= $form->field($model, 'family_position_id')->textInput() ?>

    <?= $form->field($model, 'drug_allergy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_update')->textInput() ?>

    <?= $form->field($model, 'death')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pttype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pttype_begin_date')->textInput() ?>

    <?= $form->field($model, 'pttype_expire_date')->textInput() ?>

    <?= $form->field($model, 'pttype_hospmain')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pttype_hospsub')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'father_person_id')->textInput() ?>

    <?= $form->field($model, 'mother_person_id')->textInput() ?>

    <?= $form->field($model, 'pttype_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sps_person_id')->textInput() ?>

    <?= $form->field($model, 'birthtime')->textInput() ?>

    <?= $form->field($model, 'age_y')->textInput() ?>

    <?= $form->field($model, 'age_m')->textInput() ?>

    <?= $form->field($model, 'age_d')->textInput() ?>

    <?= $form->field($model, 'family_id')->textInput() ?>

    <?= $form->field($model, 'person_house_position_id')->textInput() ?>

    <?= $form->field($model, 'couple_person_id')->textInput() ?>

    <?= $form->field($model, 'person_guid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'house_guid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_update_pttype')->textInput() ?>

    <?= $form->field($model, 'patient_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patient_hn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'found_dw_emr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_discharge_id')->textInput() ?>

    <?= $form->field($model, 'movein_date')->textInput() ?>

    <?= $form->field($model, 'discharge_date')->textInput() ?>

    <?= $form->field($model, 'person_labor_type_id')->textInput() ?>

    <?= $form->field($model, 'father_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sps_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'father_cid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_cid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sps_cid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bloodgroup_rh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'home_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'old_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deformed_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ncd_dm_history_type_id')->textInput() ?>

    <?= $form->field($model, 'ncd_ht_history_type_id')->textInput() ?>

    <?= $form->field($model, 'agriculture_member_type_id')->textInput() ?>

    <?= $form->field($model, 'senile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'in_region')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body_weight_kg')->textInput() ?>

    <?= $form->field($model, 'height_cm')->textInput() ?>

    <?= $form->field($model, 'nutrition_level')->textInput() ?>

    <?= $form->field($model, 'height_nutrition_level')->textInput() ?>

    <?= $form->field($model, 'bw_ht_nutrition_level')->textInput() ?>

    <?= $form->field($model, 'hometel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'worktel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'register_conflict')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'care_person_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_addr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_dm_screen_status_id')->textInput() ?>

    <?= $form->field($model, 'person_ht_screen_status_id')->textInput() ?>

    <?= $form->field($model, 'person_stroke_screen_status_id')->textInput() ?>

    <?= $form->field($model, 'person_obesity_screen_status_id')->textInput() ?>

    <?= $form->field($model, 'person_dmht_manage_type_id')->textInput() ?>

    <?= $form->field($model, 'last_screen_dmht_bdg_year')->textInput() ?>

    <?= $form->field($model, 'dw_chronic_register')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kcheck')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
