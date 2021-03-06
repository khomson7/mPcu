<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "drugitems2".
 *
 * @property string $icode
 * @property string $name
 * @property string $strength
 * @property string $units
 * @property double $unitprice
 * @property string $dosageform
 * @property int $criticalpriority
 * @property string $drugaccount
 * @property string $drugcategory
 * @property string $drugnote
 * @property string $hintcode
 * @property string $istatus
 * @property string $lastupdatestdprice
 * @property string $lockprice
 * @property string $lockprint
 * @property int $maxlevel
 * @property int $minlevel
 * @property int $maxunitperdose
 * @property int $packqty
 * @property int $reorderqty
 * @property double $stdprice
 * @property string $stdtaken
 * @property string $therapeutic
 * @property string $therapeuticgroup
 * @property int $default_qty
 * @property string $gpo_code
 * @property string $use_right
 * @property string $i_type
 * @property string $drugusage
 * @property string $high_cost
 * @property string $must_paid
 * @property int $alert_level
 * @property int $access_level
 * @property string $sticker_short_name
 * @property string $paidst
 * @property string $antibiotic
 * @property int $displaycolor
 * @property string $empty
 * @property string $empty_text
 * @property double $unitcost
 * @property string $gfmiscode
 * @property double $ipd_price
 * @property string $oldcode
 * @property string $habit_forming
 * @property string $did
 * @property string $stock_type
 * @property double $price2
 * @property double $price3
 * @property double $ipd_price2
 * @property double $ipd_price3
 * @property string $price_lock
 * @property string $pregnancy
 * @property int $pharmacology_group1
 * @property int $pharmacology_group2
 * @property int $pharmacology_group3
 * @property string $generic_name
 * @property string $show_pregnancy_alert
 * @property string $icode_guid
 * @property string $na
 * @property string $invcode
 * @property string $check_user_group
 * @property string $check_user_name
 * @property string $show_notify
 * @property string $show_notify_text
 * @property string $income
 * @property string $print_sticker_pq
 * @property string $charge_service_opd
 * @property string $charge_service_ipd
 * @property string $ename
 * @property string $dose_type
 * @property int $habit_forming_type
 * @property string $no_discount
 * @property string $therapeutic_eng
 * @property string $hintcode_eng
 * @property string $limit_drugusage
 * @property string $print_sticker_header
 * @property string $calc_idr_qty
 * @property string $item_in_hospital
 * @property string $no_substock
 * @property int $volume_cc
 * @property string $usage_code
 * @property string $frequency_code
 * @property string $time_code
 * @property double $dispense_dose
 * @property string $usage_unit_code
 * @property double $dose_per_units
 * @property int $ipd_default_pay
 * @property string $billcode
 * @property string $billnumber
 * @property string $lockprint_ipd
 * @property string $pregnancy_notify_text
 * @property string $show_breast_feeding_alert
 * @property string $breast_feeding_alert_text
 * @property string $show_child_notify
 * @property string $child_notify_text
 * @property int $child_notify_min_age
 * @property int $child_notify_max_age
 * @property string $continuous
 * @property string $substitute_icode
 * @property string $trade_name
 * @property string $use_right_allow
 * @property int $medication_machine_id
 * @property int $ipd_medication_machine_id
 * @property string $check_remed_qty
 * @property string $addict
 * @property int $addict_type_id
 * @property int $medication_machine_opd_no
 * @property int $medication_machine_ipd_no
 * @property string $fp_drug
 * @property string $usage_code_ipd
 * @property double $dispense_dose_ipd
 * @property string $usage_unit_code_ipd
 * @property string $frequency_code_ipd
 * @property string $time_code_ipd
 * @property string $print_ipd_injection_sticker
 * @property string $provis_medication_unit_code
 * @property string $hos_guid
 * @property int $sks_product_category_id
 * @property int $sks_clain_control_type_id
 * @property string $sks_drug_code
 * @property string $sks_dfs_code
 * @property string $sks_dfs_text
 * @property double $sks_reimb_price
 * @property string $hos_guid_ext
 * @property string $check_druginteraction_history
 * @property int $check_druginteraction_history_day
 * @property int $nhso_adp_type_id
 * @property string $nhso_adp_code
 * @property int $sks_claim_control_type_id
 * @property string $begin_date
 * @property string $finish_date
 * @property string $name_pr
 * @property string $name_eng
 * @property string $capacity_name
 * @property string $finish_reason
 * @property double $extra_unitcost
 * @property int $drug_control_type_id
 * @property string $name_print
 * @property double $active_ingredient_mg
 * @property string $no_order_g6pd
 * @property string $gender_check
 * @property string $no_order_gender
 * @property int $max_qty
 * @property string $prefer_opd_usage_code
 * @property double $capacity_qty
 * @property string $need_order_reason
 * @property int $drugitems_due_type_id
 * @property int $drugeval_head_id
 * @property string $light_protect
 * @property string $tpu_code_list
 * @property string $inv_map_update
 * @property string $special_advice_text
 * @property string $precaution_advice_text
 * @property string $contra_advice_text
 * @property string $storage_advice_text
 * @property string $qr_code_url
 * @property double $vat_percent
 * @property string $acc_regist
 * @property string $use_paidst
 * @property string $thai_name
 * @property int $fwf_item_id
 * @property int $drugitems_em1_id
 * @property int $drugitems_em2_id
 * @property int $drugitems_em3_id
 * @property int $drugitems_em4_id
 * @property string $tmt_tp_code
 * @property string $tmt_gp_code
 * @property string $limit_pttype
 * @property string $noshow_narcotic
 * @property string $medication_machine_flag
 * @property double $sks_price
 * @property string $print_sticker_by_frequency
 * @property string $print_sticker_pq_ipd
 * @property string $sub_income
 * @property string $prefer_ipd_usage_code
 * @property int $default_qty_ipd
 * @property int $max_qty_ipd
 * @property string $drugusage_ipd
 * @property string $no_popup_ipd_reason
 * @property string $specprep
 * @property int $med_dose_calc_type_id
 * @property string $send_line_notify
 * @property string $show_qrcode_trade
 * @property string $warn_g6pd
 * @property int $ipd_rx_freq_day
 */
class Drugitems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'drugitems_10918';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['icode'], 'required'],
            [['unitprice', 'stdprice', 'unitcost', 'ipd_price', 'price2', 'price3', 'ipd_price2', 'ipd_price3', 'dispense_dose', 'dose_per_units', 'dispense_dose_ipd', 'sks_reimb_price', 'extra_unitcost', 'active_ingredient_mg', 'capacity_qty', 'vat_percent', 'sks_price'], 'number'],
            [['criticalpriority', 'maxlevel', 'minlevel', 'maxunitperdose', 'packqty', 'reorderqty', 'default_qty', 'alert_level', 'access_level', 'displaycolor', 'pharmacology_group1', 'pharmacology_group2', 'pharmacology_group3', 'habit_forming_type', 'volume_cc', 'ipd_default_pay', 'child_notify_min_age', 'child_notify_max_age', 'medication_machine_id', 'ipd_medication_machine_id', 'addict_type_id', 'medication_machine_opd_no', 'medication_machine_ipd_no', 'sks_product_category_id', 'sks_clain_control_type_id', 'check_druginteraction_history_day', 'nhso_adp_type_id', 'sks_claim_control_type_id', 'drug_control_type_id', 'max_qty', 'drugitems_due_type_id', 'drugeval_head_id', 'fwf_item_id', 'drugitems_em1_id', 'drugitems_em2_id', 'drugitems_em3_id', 'drugitems_em4_id', 'default_qty_ipd', 'max_qty_ipd', 'med_dose_calc_type_id', 'ipd_rx_freq_day'], 'integer'],
            [['lastupdatestdprice', 'begin_date', 'finish_date'], 'safe'],
            [['empty_text', 'show_notify_text', 'pregnancy_notify_text', 'breast_feeding_alert_text', 'child_notify_text', 'special_advice_text', 'precaution_advice_text', 'contra_advice_text', 'storage_advice_text'], 'string'],
            [['icode', 'gpo_code', 'substitute_icode'], 'string', 'max' => 7],
            [['name', 'dosageform', 'name_pr', 'name_eng', 'capacity_name', 'finish_reason', 'name_print'], 'string', 'max' => 100],
            [['strength', 'units', 'sks_dfs_code'], 'string', 'max' => 50],
            [['drugaccount', 'paidst', 'income'], 'string', 'max' => 2],
            [['drugcategory', 'drugnote', 'therapeutic', 'therapeuticgroup', 'sticker_short_name', 'ename', 'sks_dfs_text'], 'string', 'max' => 150],
            [['hintcode', 'stock_type'], 'string', 'max' => 4],
            [['istatus', 'lockprice', 'lockprint', 'use_right', 'i_type', 'high_cost', 'must_paid', 'antibiotic', 'empty', 'habit_forming', 'price_lock', 'show_pregnancy_alert', 'na', 'check_user_group', 'check_user_name', 'show_notify', 'print_sticker_pq', 'charge_service_opd', 'charge_service_ipd', 'no_discount', 'limit_drugusage', 'print_sticker_header', 'calc_idr_qty', 'item_in_hospital', 'no_substock', 'lockprint_ipd', 'show_breast_feeding_alert', 'show_child_notify', 'continuous', 'use_right_allow', 'check_remed_qty', 'addict', 'fp_drug', 'print_ipd_injection_sticker', 'check_druginteraction_history', 'no_order_g6pd', 'gender_check', 'no_order_gender', 'prefer_opd_usage_code', 'need_order_reason', 'light_protect', 'inv_map_update', 'acc_regist', 'use_paidst', 'limit_pttype', 'noshow_narcotic', 'medication_machine_flag', 'print_sticker_by_frequency', 'print_sticker_pq_ipd', 'prefer_ipd_usage_code', 'no_popup_ipd_reason', 'send_line_notify', 'show_qrcode_trade', 'warn_g6pd'], 'string', 'max' => 1],
            [['stdtaken', 'drugusage', 'drugusage_ipd'], 'string', 'max' => 30],
            [['gfmiscode'], 'string', 'max' => 14],
            [['oldcode'], 'string', 'max' => 20],
            [['did'], 'string', 'max' => 27],
            [['pregnancy', 'invcode', 'usage_code', 'frequency_code', 'time_code', 'usage_unit_code', 'billcode', 'usage_code_ipd', 'usage_unit_code_ipd', 'frequency_code_ipd', 'time_code_ipd', 'provis_medication_unit_code', 'tmt_tp_code', 'tmt_gp_code', 'specprep'], 'string', 'max' => 10],
            [['generic_name'], 'string', 'max' => 250],
            [['icode_guid', 'hos_guid'], 'string', 'max' => 38],
            [['dose_type', 'sub_income'], 'string', 'max' => 3],
            [['therapeutic_eng', 'hintcode_eng', 'trade_name', 'tpu_code_list', 'qr_code_url', 'thai_name'], 'string', 'max' => 200],
            [['billnumber', 'nhso_adp_code'], 'string', 'max' => 15],
            [['sks_drug_code'], 'string', 'max' => 25],
            [['hos_guid_ext'], 'string', 'max' => 64],
            [['icode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'icode' => 'Icode',
            'name' => 'Name',
            'strength' => 'Strength',
            'units' => 'Units',
            'unitprice' => 'Unitprice',
            'dosageform' => 'Dosageform',
            'criticalpriority' => 'Criticalpriority',
            'drugaccount' => 'Drugaccount',
            'drugcategory' => 'Drugcategory',
            'drugnote' => 'Drugnote',
            'hintcode' => 'Hintcode',
            'istatus' => 'Istatus',
            'lastupdatestdprice' => 'Lastupdatestdprice',
            'lockprice' => 'Lockprice',
            'lockprint' => 'Lockprint',
            'maxlevel' => 'Maxlevel',
            'minlevel' => 'Minlevel',
            'maxunitperdose' => 'Maxunitperdose',
            'packqty' => 'Packqty',
            'reorderqty' => 'Reorderqty',
            'stdprice' => 'Stdprice',
            'stdtaken' => 'Stdtaken',
            'therapeutic' => 'Therapeutic',
            'therapeuticgroup' => 'Therapeuticgroup',
            'default_qty' => 'Default Qty',
            'gpo_code' => 'Gpo Code',
            'use_right' => 'Use Right',
            'i_type' => 'I Type',
            'drugusage' => 'Drugusage',
            'high_cost' => 'High Cost',
            'must_paid' => 'Must Paid',
            'alert_level' => 'Alert Level',
            'access_level' => 'Access Level',
            'sticker_short_name' => 'Sticker Short Name',
            'paidst' => 'Paidst',
            'antibiotic' => 'Antibiotic',
            'displaycolor' => 'Displaycolor',
            'empty' => 'Empty',
            'empty_text' => 'Empty Text',
            'unitcost' => 'Unitcost',
            'gfmiscode' => 'Gfmiscode',
            'ipd_price' => 'Ipd Price',
            'oldcode' => 'Oldcode',
            'habit_forming' => 'Habit Forming',
            'did' => 'Did',
            'stock_type' => 'Stock Type',
            'price2' => 'Price2',
            'price3' => 'Price3',
            'ipd_price2' => 'Ipd Price2',
            'ipd_price3' => 'Ipd Price3',
            'price_lock' => 'Price Lock',
            'pregnancy' => 'Pregnancy',
            'pharmacology_group1' => 'Pharmacology Group1',
            'pharmacology_group2' => 'Pharmacology Group2',
            'pharmacology_group3' => 'Pharmacology Group3',
            'generic_name' => 'Generic Name',
            'show_pregnancy_alert' => 'Show Pregnancy Alert',
            'icode_guid' => 'Icode Guid',
            'na' => 'Na',
            'invcode' => 'Invcode',
            'check_user_group' => 'Check User Group',
            'check_user_name' => 'Check User Name',
            'show_notify' => 'Show Notify',
            'show_notify_text' => 'Show Notify Text',
            'income' => 'Income',
            'print_sticker_pq' => 'Print Sticker Pq',
            'charge_service_opd' => 'Charge Service Opd',
            'charge_service_ipd' => 'Charge Service Ipd',
            'ename' => 'Ename',
            'dose_type' => 'Dose Type',
            'habit_forming_type' => 'Habit Forming Type',
            'no_discount' => 'No Discount',
            'therapeutic_eng' => 'Therapeutic Eng',
            'hintcode_eng' => 'Hintcode Eng',
            'limit_drugusage' => 'Limit Drugusage',
            'print_sticker_header' => 'Print Sticker Header',
            'calc_idr_qty' => 'Calc Idr Qty',
            'item_in_hospital' => 'Item In Hospital',
            'no_substock' => 'No Substock',
            'volume_cc' => 'Volume Cc',
            'usage_code' => 'Usage Code',
            'frequency_code' => 'Frequency Code',
            'time_code' => 'Time Code',
            'dispense_dose' => 'Dispense Dose',
            'usage_unit_code' => 'Usage Unit Code',
            'dose_per_units' => 'Dose Per Units',
            'ipd_default_pay' => 'Ipd Default Pay',
            'billcode' => 'Billcode',
            'billnumber' => 'Billnumber',
            'lockprint_ipd' => 'Lockprint Ipd',
            'pregnancy_notify_text' => 'Pregnancy Notify Text',
            'show_breast_feeding_alert' => 'Show Breast Feeding Alert',
            'breast_feeding_alert_text' => 'Breast Feeding Alert Text',
            'show_child_notify' => 'Show Child Notify',
            'child_notify_text' => 'Child Notify Text',
            'child_notify_min_age' => 'Child Notify Min Age',
            'child_notify_max_age' => 'Child Notify Max Age',
            'continuous' => 'Continuous',
            'substitute_icode' => 'Substitute Icode',
            'trade_name' => 'Trade Name',
            'use_right_allow' => 'Use Right Allow',
            'medication_machine_id' => 'Medication Machine ID',
            'ipd_medication_machine_id' => 'Ipd Medication Machine ID',
            'check_remed_qty' => 'Check Remed Qty',
            'addict' => 'Addict',
            'addict_type_id' => 'Addict Type ID',
            'medication_machine_opd_no' => 'Medication Machine Opd No',
            'medication_machine_ipd_no' => 'Medication Machine Ipd No',
            'fp_drug' => 'Fp Drug',
            'usage_code_ipd' => 'Usage Code Ipd',
            'dispense_dose_ipd' => 'Dispense Dose Ipd',
            'usage_unit_code_ipd' => 'Usage Unit Code Ipd',
            'frequency_code_ipd' => 'Frequency Code Ipd',
            'time_code_ipd' => 'Time Code Ipd',
            'print_ipd_injection_sticker' => 'Print Ipd Injection Sticker',
            'provis_medication_unit_code' => 'Provis Medication Unit Code',
            'hos_guid' => 'Hos Guid',
            'sks_product_category_id' => 'Sks Product Category ID',
            'sks_clain_control_type_id' => 'Sks Clain Control Type ID',
            'sks_drug_code' => 'Sks Drug Code',
            'sks_dfs_code' => 'Sks Dfs Code',
            'sks_dfs_text' => 'Sks Dfs Text',
            'sks_reimb_price' => 'Sks Reimb Price',
            'hos_guid_ext' => 'Hos Guid Ext',
            'check_druginteraction_history' => 'Check Druginteraction History',
            'check_druginteraction_history_day' => 'Check Druginteraction History Day',
            'nhso_adp_type_id' => 'Nhso Adp Type ID',
            'nhso_adp_code' => 'Nhso Adp Code',
            'sks_claim_control_type_id' => 'Sks Claim Control Type ID',
            'begin_date' => 'Begin Date',
            'finish_date' => 'Finish Date',
            'name_pr' => 'Name Pr',
            'name_eng' => 'Name Eng',
            'capacity_name' => 'Capacity Name',
            'finish_reason' => 'Finish Reason',
            'extra_unitcost' => 'Extra Unitcost',
            'drug_control_type_id' => 'Drug Control Type ID',
            'name_print' => 'Name Print',
            'active_ingredient_mg' => 'Active Ingredient Mg',
            'no_order_g6pd' => 'No Order G6pd',
            'gender_check' => 'Gender Check',
            'no_order_gender' => 'No Order Gender',
            'max_qty' => 'Max Qty',
            'prefer_opd_usage_code' => 'Prefer Opd Usage Code',
            'capacity_qty' => 'Capacity Qty',
            'need_order_reason' => 'Need Order Reason',
            'drugitems_due_type_id' => 'Drugitems Due Type ID',
            'drugeval_head_id' => 'Drugeval Head ID',
            'light_protect' => 'Light Protect',
            'tpu_code_list' => 'Tpu Code List',
            'inv_map_update' => 'Inv Map Update',
            'special_advice_text' => 'Special Advice Text',
            'precaution_advice_text' => 'Precaution Advice Text',
            'contra_advice_text' => 'Contra Advice Text',
            'storage_advice_text' => 'Storage Advice Text',
            'qr_code_url' => 'Qr Code Url',
            'vat_percent' => 'Vat Percent',
            'acc_regist' => 'Acc Regist',
            'use_paidst' => 'Use Paidst',
            'thai_name' => 'Thai Name',
            'fwf_item_id' => 'Fwf Item ID',
            'drugitems_em1_id' => 'Drugitems Em1 ID',
            'drugitems_em2_id' => 'Drugitems Em2 ID',
            'drugitems_em3_id' => 'Drugitems Em3 ID',
            'drugitems_em4_id' => 'Drugitems Em4 ID',
            'tmt_tp_code' => 'Tmt Tp Code',
            'tmt_gp_code' => 'Tmt Gp Code',
            'limit_pttype' => 'Limit Pttype',
            'noshow_narcotic' => 'Noshow Narcotic',
            'medication_machine_flag' => 'Medication Machine Flag',
            'sks_price' => 'Sks Price',
            'print_sticker_by_frequency' => 'Print Sticker By Frequency',
            'print_sticker_pq_ipd' => 'Print Sticker Pq Ipd',
            'sub_income' => 'Sub Income',
            'prefer_ipd_usage_code' => 'Prefer Ipd Usage Code',
            'default_qty_ipd' => 'Default Qty Ipd',
            'max_qty_ipd' => 'Max Qty Ipd',
            'drugusage_ipd' => 'Drugusage Ipd',
            'no_popup_ipd_reason' => 'No Popup Ipd Reason',
            'specprep' => 'Specprep',
            'med_dose_calc_type_id' => 'Med Dose Calc Type ID',
            'send_line_notify' => 'Send Line Notify',
            'show_qrcode_trade' => 'Show Qrcode Trade',
            'warn_g6pd' => 'Warn G6pd',
            'ipd_rx_freq_day' => 'Ipd Rx Freq Day',
        ];
    }
}
