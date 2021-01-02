<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use hauntd\vote\widgets\Vote;
use kartik\widgets\StarRating;
use kartik\widgets\Alert;
?>

<?php
echo Alert::widget([
    'type' => Alert::TYPE_DANGER,
    'title' => 'Note',
    'titleOptions' => ['icon' => 'info-sign'],
    'body' => 'ยาที่ท่านเลือกจะถูกนำเข้าไปที่ฐานข้อมูลอัตโนมัติ'
]);
?>

<div class="mdrugitems-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'icode')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'strength')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'units') ?>

    <?= $form->field($model, 'unitprice')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'dosageform')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'criticalpriority')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'drugaccount')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'drugcategory')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'drugnote')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'hintcode')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'istatus')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'lastupdatestdprice')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'lockprice')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'lockprint')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'maxlevel')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'minlevel')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'maxunitperdose')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'packqty')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'reorderqty')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'stdprice')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'stdtaken')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'therapeutic')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'therapeuticgroup')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'default_qty')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'gpo_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'use_right')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'i_type')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'drugusage')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'high_cost')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'must_paid')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'alert_level')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'access_level')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'sticker_short_name')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'paidst')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'antibiotic')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'displaycolor')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'empty')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'empty_text')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'unitcost')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'gfmiscode')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'ipd_price')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'oldcode')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'habit_forming')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'did')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'stock_type')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'price2')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'price3')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'ipd_price2')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'ipd_price3')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'price_lock')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'pregnancy')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'pharmacology_group1')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'pharmacology_group2')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'pharmacology_group3')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'generic_name')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'show_pregnancy_alert')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'icode_guid')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'na')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'invcode')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'check_user_group')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'check_user_name')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'show_notify')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'show_notify_text')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'income')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'print_sticker_pq')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'charge_service_opd')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'charge_service_ipd')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'ename')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'dose_type')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'habit_forming_type')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'no_discount')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'therapeutic_eng')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'hintcode_eng')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'limit_drugusage')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'print_sticker_header')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'calc_idr_qty')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'item_in_hospital')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'no_substock')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'volume_cc')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'usage_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'frequency_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'time_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'dispense_dose')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'usage_unit_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'dose_per_units')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'ipd_default_pay')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'billcode')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'billnumber')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'lockprint_ipd')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'pregnancy_notify_text')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'show_breast_feeding_alert')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'breast_feeding_alert_text')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'show_child_notify')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'child_notify_text')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'child_notify_min_age')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'child_notify_max_age')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'continuous')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'substitute_icode')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'trade_name')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'use_right_allow')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'medication_machine_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'ipd_medication_machine_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'check_remed_qty')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'addict')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'addict_type_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'medication_machine_opd_no')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'medication_machine_ipd_no')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'fp_drug')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'usage_code_ipd')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'dispense_dose_ipd')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'usage_unit_code_ipd')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'frequency_code_ipd')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'time_code_ipd')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'print_ipd_injection_sticker')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'provis_medication_unit_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'hos_guid')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'sks_product_category_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'sks_clain_control_type_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'sks_drug_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'sks_dfs_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'sks_dfs_text')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'sks_reimb_price')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'hos_guid_ext')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'check_druginteraction_history')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'check_druginteraction_history_day')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'nhso_adp_type_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'nhso_adp_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'sks_claim_control_type_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'begin_date')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'finish_date')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'name_pr')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'name_eng')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'capacity_name')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'finish_reason')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'extra_unitcost')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'drug_control_type_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'name_print')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'active_ingredient_mg')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'no_order_g6pd')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'gender_check')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'no_order_gender')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'max_qty')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'prefer_opd_usage_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'capacity_qty')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'need_order_reason')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'drugitems_due_type_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'drugeval_head_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'light_protect')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'tpu_code_list')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'sks_specprep')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'inv_map_update')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'special_advice_text')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'precaution_advice_text')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'contra_advice_text')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'storage_advice_text')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'qr_code_url')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'vat_percent')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'acc_regist')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'use_paidst')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'thai_name')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'fwf_item_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'drugitems_em1_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'drugitems_em2_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'drugitems_em3_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'drugitems_em4_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'tmt_tp_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'tmt_gp_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'limit_pttype')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'noshow_narcotic')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'medication_machine_flag')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'sks_price')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'print_sticker_by_frequency')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'print_sticker_pq_ipd')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'dmi')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'sub_income')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'prefer_ipd_usage_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'default_qty_ipd')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'max_qty_ipd')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'drugusage_ipd')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'no_popup_ipd_reason')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'specprep')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'med_dose_calc_type_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'send_line_notify')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'show_qrcode_trade')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'warn_g6pd')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'ipd_rx_freq_day')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'displaycolor_focus')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'last_update')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'no_remed')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'force_round_qty')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'atc_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'state_item_id')->hiddenInput()->label(FALSE) ?>
    
    <?= $form->field($model, 'check_status')->hiddenInput()->label(FALSE) ?>
    
    <?= $form->field($model, 'check_anti')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($modelsdrug, 'icode')->hiddenInput()->label(FALSE) ?>
    <?= $form->field($modelsdrug, 'name')->hiddenInput()->label(FALSE) ?>
    <?= $form->field($modelsdrug, 'strength')->hiddenInput()->label(FALSE) ?>
    <?= $form->field($modelsdrug, 'units')->hiddenInput()->label(FALSE) ?>
    <?= $form->field($modelsdrug, 'dosageform')->hiddenInput()->label(FALSE) ?>
    <?= $form->field($modelsdrug, 'drugnote')->hiddenInput()->label(FALSE) ?>
    <?= $form->field($modelsdrug, 'use_right')->hiddenInput()->label(FALSE) ?>
    <?= $form->field($modelsdrug, 'must_paid')->hiddenInput()->label(FALSE) ?>
    <?= $form->field($modelsdrug, 'istatus')->hiddenInput()->label(FALSE) ?>
    <?= $form->field($modelsdrug, 'access_level')->hiddenInput()->label(FALSE) ?>
    <?= $form->field($modelsdrug, 'paidst')->hiddenInput()->label(FALSE) ?>
    <?= $form->field($modelsdrug, 'displaycolor')->hiddenInput()->label(FALSE) ?>
    <?= $form->field($modelsdrug, 'price_lock')->hiddenInput()->label(FALSE) ?> 
    <?= $form->field($modelsdrug, 'ename')->hiddenInput()->label(FALSE) ?>
    <?= $form->field($modelsdrug, 'cost')->hiddenInput()->label(FALSE) ?>
    <?= $form->field($modelsdrug, 'income')->hiddenInput()->label(FALSE) ?>
    <?= $form->field($modelsdrug, 'is_medication')->hiddenInput()->label(FALSE) ?>
    <?= $form->field($modelsdrug, 'use_paidst')->hiddenInput()->label(FALSE) ?>
    <?= $form->field($modelsdrug, 'is_medsupply')->hiddenInput()->label(FALSE) ?>
    <?= $form->field($modelsdrug, 'sub_income')->hiddenInput()->label(FALSE) ?>
<?= $form->field($modelsdrug, 'highcost')->hiddenInput()->label(FALSE) ?>
<?= $form->field($modelsdrug, 'oldcode')->hiddenInput()->label(FALSE) ?>


    <div class="form-group">
    <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
