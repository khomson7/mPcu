<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pttype".
 *
 * @property string $pttype
 * @property string $name
 * @property string $editmask
 * @property string $isuse
 * @property string $pcode
 * @property string $requirecode
 * @property string $doctor_fee
 * @property string $fee_code
 * @property int $discount
 * @property string $contract
 * @property string $paidst
 * @property string $in_region
 * @property string $uc
 * @property string $require_hcode
 * @property string $oldcode
 * @property string $fee_code2
 * @property int $price_type
 * @property string $debtor
 * @property string $noexpire
 * @property string $hipdata_code
 * @property int $min_age
 * @property int $max_age
 * @property string $bill_sss
 * @property int $bill_type
 * @property string $hipdata_pttype
 * @property string $use_contract_id
 * @property string $yearly_charge
 * @property string $yearly_charge_icode1
 * @property string $yearly_charge_icode2
 * @property int $region_type
 * @property string $pttype_group1
 * @property string $pttype_group2
 * @property string $pttype_guid
 * @property double $max_debt_money
 * @property string $allow_finance_edit
 * @property string $print_csmb_statement
 * @property string $pttype_information
 * @property string $fee_code_paidst
 * @property string $fee_code2_paidst
 * @property int $debt_due_day
 * @property string $rx_pay_debit_tr
 * @property string $separate_rcpno
 * @property int $rcp_bookno
 * @property string $separate_debt_id
 * @property string $admit_fee_code
 * @property string $use_package
 * @property string $charge_df_perday
 * @property string $nhso_code
 * @property int $ipd_hour_cut
 * @property int $pttype_spp_id
 * @property string $print_presc_ned
 * @property string $hos_guid
 * @property int $sks_benefit_plan_type_id
 * @property string $pttype_std_code
 * @property string $export_eclaim
 * @property string $round_money
 * @property string $uc_incup
 * @property int $pttype_price_policy_type_id
 * @property string $emp_privilege
 * @property string $is_pttype_plan
 * @property string $finance_round_money
 * @property string $emp_financial
 * @property string $pttype_eclaim_id
 * @property int $pttype_price_group_id
 * @property string $calc_discount
 * @property double $debt_finance_limit
 * @property string $debt_finance_pttype
 * @property string $opbkk_type_code
 * @property string $ipd_bedcharge_24
 * @property string $nhso_subinscl
 * @property int $grouper_version
 * @property int $rx_queue_group_id
 * @property string $inc_round_money
 * @property string $hospmain_list
 */
class Pttype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pttype';
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
            [['pttype'], 'required'],
            [['discount', 'price_type', 'min_age', 'max_age', 'bill_type', 'region_type', 'debt_due_day', 'rcp_bookno', 'ipd_hour_cut', 'pttype_spp_id', 'sks_benefit_plan_type_id', 'pttype_price_policy_type_id', 'pttype_price_group_id', 'grouper_version', 'rx_queue_group_id'], 'integer'],
            [['max_debt_money', 'debt_finance_limit'], 'number'],
            [['pttype_information'], 'string'],
            [['pttype', 'pcode', 'paidst', 'fee_code_paidst', 'fee_code2_paidst', 'nhso_code', 'pttype_eclaim_id', 'debt_finance_pttype', 'opbkk_type_code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 250],
            [['editmask', 'hospmain_list'], 'string', 'max' => 100],
            [['isuse', 'requirecode', 'doctor_fee', 'contract', 'in_region', 'uc', 'require_hcode', 'debtor', 'noexpire', 'bill_sss', 'use_contract_id', 'yearly_charge', 'allow_finance_edit', 'print_csmb_statement', 'rx_pay_debit_tr', 'separate_rcpno', 'separate_debt_id', 'use_package', 'charge_df_perday', 'print_presc_ned', 'export_eclaim', 'round_money', 'uc_incup', 'emp_privilege', 'is_pttype_plan', 'finance_round_money', 'emp_financial', 'calc_discount', 'ipd_bedcharge_24', 'inc_round_money'], 'string', 'max' => 1],
            [['fee_code', 'fee_code2', 'yearly_charge_icode1', 'yearly_charge_icode2', 'admit_fee_code'], 'string', 'max' => 7],
            [['oldcode'], 'string', 'max' => 5],
            [['hipdata_code'], 'string', 'max' => 6],
            [['hipdata_pttype', 'pttype_group1', 'pttype_group2', 'nhso_subinscl'], 'string', 'max' => 3],
            [['pttype_guid', 'hos_guid'], 'string', 'max' => 38],
            [['pttype_std_code'], 'string', 'max' => 4],
            [['pttype'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pttype' => 'Pttype',
            'name' => 'Name',
            'editmask' => 'Editmask',
            'isuse' => 'Isuse',
            'pcode' => 'Pcode',
            'requirecode' => 'Requirecode',
            'doctor_fee' => 'Doctor Fee',
            'fee_code' => 'Fee Code',
            'discount' => 'Discount',
            'contract' => 'Contract',
            'paidst' => 'Paidst',
            'in_region' => 'In Region',
            'uc' => 'Uc',
            'require_hcode' => 'Require Hcode',
            'oldcode' => 'Oldcode',
            'fee_code2' => 'Fee Code2',
            'price_type' => 'Price Type',
            'debtor' => 'Debtor',
            'noexpire' => 'Noexpire',
            'hipdata_code' => 'Hipdata Code',
            'min_age' => 'Min Age',
            'max_age' => 'Max Age',
            'bill_sss' => 'Bill Sss',
            'bill_type' => 'Bill Type',
            'hipdata_pttype' => 'Hipdata Pttype',
            'use_contract_id' => 'Use Contract ID',
            'yearly_charge' => 'Yearly Charge',
            'yearly_charge_icode1' => 'Yearly Charge Icode1',
            'yearly_charge_icode2' => 'Yearly Charge Icode2',
            'region_type' => 'Region Type',
            'pttype_group1' => 'Pttype Group1',
            'pttype_group2' => 'Pttype Group2',
            'pttype_guid' => 'Pttype Guid',
            'max_debt_money' => 'Max Debt Money',
            'allow_finance_edit' => 'Allow Finance Edit',
            'print_csmb_statement' => 'Print Csmb Statement',
            'pttype_information' => 'Pttype Information',
            'fee_code_paidst' => 'Fee Code Paidst',
            'fee_code2_paidst' => 'Fee Code2 Paidst',
            'debt_due_day' => 'Debt Due Day',
            'rx_pay_debit_tr' => 'Rx Pay Debit Tr',
            'separate_rcpno' => 'Separate Rcpno',
            'rcp_bookno' => 'Rcp Bookno',
            'separate_debt_id' => 'Separate Debt ID',
            'admit_fee_code' => 'Admit Fee Code',
            'use_package' => 'Use Package',
            'charge_df_perday' => 'Charge Df Perday',
            'nhso_code' => 'Nhso Code',
            'ipd_hour_cut' => 'Ipd Hour Cut',
            'pttype_spp_id' => 'Pttype Spp ID',
            'print_presc_ned' => 'Print Presc Ned',
            'hos_guid' => 'Hos Guid',
            'sks_benefit_plan_type_id' => 'Sks Benefit Plan Type ID',
            'pttype_std_code' => 'Pttype Std Code',
            'export_eclaim' => 'Export Eclaim',
            'round_money' => 'Round Money',
            'uc_incup' => 'Uc Incup',
            'pttype_price_policy_type_id' => 'Pttype Price Policy Type ID',
            'emp_privilege' => 'Emp Privilege',
            'is_pttype_plan' => 'Is Pttype Plan',
            'finance_round_money' => 'Finance Round Money',
            'emp_financial' => 'Emp Financial',
            'pttype_eclaim_id' => 'Pttype Eclaim ID',
            'pttype_price_group_id' => 'Pttype Price Group ID',
            'calc_discount' => 'Calc Discount',
            'debt_finance_limit' => 'Debt Finance Limit',
            'debt_finance_pttype' => 'Debt Finance Pttype',
            'opbkk_type_code' => 'Opbkk Type Code',
            'ipd_bedcharge_24' => 'Ipd Bedcharge 24',
            'nhso_subinscl' => 'Nhso Subinscl',
            'grouper_version' => 'Grouper Version',
            'rx_queue_group_id' => 'Rx Queue Group ID',
            'inc_round_money' => 'Inc Round Money',
            'hospmain_list' => 'Hospmain List',
        ];
    }
}
