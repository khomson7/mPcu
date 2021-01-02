<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\Patient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hos_guid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'occupation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'citizenship')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthday')->textInput() ?>

    <?= $form->field($model, 'addrpart')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'moopart')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tmbpart')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amppart')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chwpart')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bloodgrp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clinic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deathday')->textInput() ?>

    <?= $form->field($model, 'drugallergy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'familyno')->textInput() ?>

    <?= $form->field($model, 'fathername')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstday')->textInput() ?>

    <?= $form->field($model, 'hometel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'informaddr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'informname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'informrelation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'informtel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marrystatus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mathername')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hn_int')->textInput() ?>

    <?= $form->field($model, 'nationality')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opdlocation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pttype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'religion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'spsname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'truebirthday')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'workaddr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'worktel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hid')->textInput() ?>

    <?= $form->field($model, 'educate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'family_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'labor_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_update')->textInput() ?>

    <?= $form->field($model, 'type_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'road')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'father_cid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_cid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'couple_cid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'private_doctor_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'legal_action')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'death_code504')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'death_diag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'node_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'admit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'midname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'po_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fatherlname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'motherlname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'spslname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthtime')->textInput() ?>

    <?= $form->field($model, 'mother_hn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_visit')->textInput() ?>

    <?= $form->field($model, 'death')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'height')->textInput() ?>

    <?= $form->field($model, 'inregion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reg_time')->textInput() ?>

    <?= $form->field($model, 'oldcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gov_chronic_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'in_cups')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patient_type_id')->textInput() ?>

    <?= $form->field($model, 'addr_soi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_addr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'father_hn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'destroyed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'old_addr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fname_soundex')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lname_soundex')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bloodgroup_rh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passport_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'addressid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kcheck')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile_phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anonymous_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ec_fname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ec_lname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hospital_department_id')->textInput() ?>

    <?= $form->field($model, 'membercard_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ec_relation_type_id')->textInput() ?>

    <?= $form->field($model, 'patient_color_id')->textInput() ?>

    <?= $form->field($model, 'number_of_relatives')->textInput() ?>

    <?= $form->field($model, 'birth_order')->textInput() ?>

    <?= $form->field($model, 'person_labor_type_id')->textInput() ?>

    <?= $form->field($model, 'is_card_destroy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_destroy_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
