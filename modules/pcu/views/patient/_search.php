<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\PatientSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'hos_guid') ?>

    <?= $form->field($model, 'hn') ?>

    <?= $form->field($model, 'pname') ?>

    <?= $form->field($model, 'fname') ?>

    <?= $form->field($model, 'lname') ?>

    <?php // echo $form->field($model, 'occupation') ?>

    <?php // echo $form->field($model, 'citizenship') ?>

    <?php // echo $form->field($model, 'birthday') ?>

    <?php // echo $form->field($model, 'addrpart') ?>

    <?php // echo $form->field($model, 'moopart') ?>

    <?php // echo $form->field($model, 'tmbpart') ?>

    <?php // echo $form->field($model, 'amppart') ?>

    <?php // echo $form->field($model, 'chwpart') ?>

    <?php // echo $form->field($model, 'bloodgrp') ?>

    <?php // echo $form->field($model, 'clinic') ?>

    <?php // echo $form->field($model, 'deathday') ?>

    <?php // echo $form->field($model, 'drugallergy') ?>

    <?php // echo $form->field($model, 'familyno') ?>

    <?php // echo $form->field($model, 'fathername') ?>

    <?php // echo $form->field($model, 'firstday') ?>

    <?php // echo $form->field($model, 'hometel') ?>

    <?php // echo $form->field($model, 'informaddr') ?>

    <?php // echo $form->field($model, 'informname') ?>

    <?php // echo $form->field($model, 'informrelation') ?>

    <?php // echo $form->field($model, 'informtel') ?>

    <?php // echo $form->field($model, 'marrystatus') ?>

    <?php // echo $form->field($model, 'mathername') ?>

    <?php // echo $form->field($model, 'hn_int') ?>

    <?php // echo $form->field($model, 'nationality') ?>

    <?php // echo $form->field($model, 'opdlocation') ?>

    <?php // echo $form->field($model, 'pttype') ?>

    <?php // echo $form->field($model, 'religion') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'spsname') ?>

    <?php // echo $form->field($model, 'truebirthday') ?>

    <?php // echo $form->field($model, 'workaddr') ?>

    <?php // echo $form->field($model, 'worktel') ?>

    <?php // echo $form->field($model, 'hcode') ?>

    <?php // echo $form->field($model, 'cid') ?>

    <?php // echo $form->field($model, 'hid') ?>

    <?php // echo $form->field($model, 'educate') ?>

    <?php // echo $form->field($model, 'family_status') ?>

    <?php // echo $form->field($model, 'labor_type') ?>

    <?php // echo $form->field($model, 'last_update') ?>

    <?php // echo $form->field($model, 'type_area') ?>

    <?php // echo $form->field($model, 'road') ?>

    <?php // echo $form->field($model, 'father_cid') ?>

    <?php // echo $form->field($model, 'mother_cid') ?>

    <?php // echo $form->field($model, 'couple_cid') ?>

    <?php // echo $form->field($model, 'person_type') ?>

    <?php // echo $form->field($model, 'private_doctor_name') ?>

    <?php // echo $form->field($model, 'legal_action') ?>

    <?php // echo $form->field($model, 'death_code504') ?>

    <?php // echo $form->field($model, 'death_diag') ?>

    <?php // echo $form->field($model, 'node_id') ?>

    <?php // echo $form->field($model, 'admit') ?>

    <?php // echo $form->field($model, 'midname') ?>

    <?php // echo $form->field($model, 'po_code') ?>

    <?php // echo $form->field($model, 'fatherlname') ?>

    <?php // echo $form->field($model, 'motherlname') ?>

    <?php // echo $form->field($model, 'spslname') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'birthtime') ?>

    <?php // echo $form->field($model, 'mother_hn') ?>

    <?php // echo $form->field($model, 'last_visit') ?>

    <?php // echo $form->field($model, 'death') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'inregion') ?>

    <?php // echo $form->field($model, 'reg_time') ?>

    <?php // echo $form->field($model, 'oldcode') ?>

    <?php // echo $form->field($model, 'lang') ?>

    <?php // echo $form->field($model, 'gov_chronic_id') ?>

    <?php // echo $form->field($model, 'in_cups') ?>

    <?php // echo $form->field($model, 'patient_type_id') ?>

    <?php // echo $form->field($model, 'addr_soi') ?>

    <?php // echo $form->field($model, 'work_addr') ?>

    <?php // echo $form->field($model, 'father_hn') ?>

    <?php // echo $form->field($model, 'alias_name') ?>

    <?php // echo $form->field($model, 'destroyed') ?>

    <?php // echo $form->field($model, 'old_addr') ?>

    <?php // echo $form->field($model, 'fname_soundex') ?>

    <?php // echo $form->field($model, 'lname_soundex') ?>

    <?php // echo $form->field($model, 'bloodgroup_rh') ?>

    <?php // echo $form->field($model, 'passport_no') ?>

    <?php // echo $form->field($model, 'addressid') ?>

    <?php // echo $form->field($model, 'kcheck') ?>

    <?php // echo $form->field($model, 'mobile_phone_number') ?>

    <?php // echo $form->field($model, 'anonymous_person') ?>

    <?php // echo $form->field($model, 'ec_fname') ?>

    <?php // echo $form->field($model, 'ec_lname') ?>

    <?php // echo $form->field($model, 'hospital_department_id') ?>

    <?php // echo $form->field($model, 'membercard_no') ?>

    <?php // echo $form->field($model, 'ec_relation_type_id') ?>

    <?php // echo $form->field($model, 'patient_color_id') ?>

    <?php // echo $form->field($model, 'number_of_relatives') ?>

    <?php // echo $form->field($model, 'birth_order') ?>

    <?php // echo $form->field($model, 'person_labor_type_id') ?>

    <?php // echo $form->field($model, 'is_card_destroy') ?>

    <?php // echo $form->field($model, 'card_destroy_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
