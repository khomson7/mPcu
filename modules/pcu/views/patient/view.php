<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\Patient */

$this->title = $model->hos_guid;
$this->params['breadcrumbs'][] = ['label' => 'Patients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->hos_guid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->hos_guid], [
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
            'hos_guid',
            'hn',
            'pname',
            'fname',
            'lname',
            'occupation',
            'citizenship',
            'birthday',
            'addrpart',
            'moopart',
            'tmbpart',
            'amppart',
            'chwpart',
            'bloodgrp',
            'clinic',
            'deathday',
            'drugallergy',
            'familyno',
            'fathername',
            'firstday',
            'hometel',
            'informaddr',
            'informname',
            'informrelation',
            'informtel',
            'marrystatus',
            'mathername',
            'hn_int',
            'nationality',
            'opdlocation',
            'pttype',
            'religion',
            'sex',
            'spsname',
            'truebirthday',
            'workaddr',
            'worktel',
            'hcode',
            'cid',
            'hid',
            'educate',
            'family_status',
            'labor_type',
            'last_update',
            'type_area',
            'road',
            'father_cid',
            'mother_cid',
            'couple_cid',
            'person_type',
            'private_doctor_name',
            'legal_action',
            'death_code504',
            'death_diag',
            'node_id',
            'admit',
            'midname',
            'po_code',
            'fatherlname',
            'motherlname',
            'spslname',
            'country',
            'email:email',
            'birthtime',
            'mother_hn',
            'last_visit',
            'death',
            'height',
            'inregion',
            'reg_time',
            'oldcode',
            'lang',
            'gov_chronic_id',
            'in_cups',
            'patient_type_id',
            'addr_soi',
            'work_addr',
            'father_hn',
            'alias_name',
            'destroyed',
            'old_addr',
            'fname_soundex',
            'lname_soundex',
            'bloodgroup_rh',
            'passport_no',
            'addressid',
            'kcheck',
            'mobile_phone_number',
            'anonymous_person',
            'ec_fname',
            'ec_lname',
            'hospital_department_id',
            'membercard_no',
            'ec_relation_type_id',
            'patient_color_id',
            'number_of_relatives',
            'birth_order',
            'person_labor_type_id',
            'is_card_destroy',
            'card_destroy_date',
        ],
    ]) ?>

</div>
