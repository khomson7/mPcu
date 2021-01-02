<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "s_drugitems".
 *
 * @property string $icode
 * @property string $name
 * @property string $strength
 * @property string $units
 * @property string $dosageform
 * @property string $drugnote
 * @property string $use_right
 * @property string $must_paid
 * @property string $istatus
 * @property int $access_level
 * @property string $paidst
 * @property int $displaycolor
 * @property string $price_lock
 * @property string $icode_guid
 * @property string $ename
 * @property double $cost
 * @property string $income
 * @property string $hos_guid
 * @property string $hos_guid_ext
 * @property string $is_medication
 * @property string $use_paidst
 * @property string $is_medsupply
 * @property string $sub_income
 * @property string $highcost
 * @property string $oldcode
 * @property string $billcode
 * @property string $billnumber
 * @property int $nhso_adp_type_id
 * @property string $nhso_adp_code
 * @property double $unitprice
 * @property int $displaycolor_focus
 * @property string $tpu_code_list
 * @property string $drugaccount
 */
class MsDrugitems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 's_drugitems';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
 
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['icode'], 'required'],
            [['access_level', 'displaycolor', 'nhso_adp_type_id', 'displaycolor_focus'], 'integer'],
            [['cost', 'unitprice'], 'number'],
            [['icode'], 'string', 'max' => 7],
            [['name', 'dosageform'], 'string', 'max' => 100],
            [['strength', 'units'], 'string', 'max' => 50],
            [['drugnote', 'ename'], 'string', 'max' => 150],
            [['use_right', 'must_paid', 'istatus', 'price_lock', 'is_medication', 'use_paidst', 'is_medsupply', 'highcost'], 'string', 'max' => 1],
            [['paidst', 'income', 'drugaccount'], 'string', 'max' => 2],
            [['icode_guid', 'hos_guid'], 'string', 'max' => 38],
            [['hos_guid_ext'], 'string', 'max' => 64],
            [['sub_income'], 'string', 'max' => 3],
            [['oldcode', 'billnumber', 'nhso_adp_code'], 'string', 'max' => 15],
            [['billcode'], 'string', 'max' => 10],
            [['tpu_code_list'], 'string', 'max' => 200],
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
            'dosageform' => 'Dosageform',
            'drugnote' => 'Drugnote',
            'use_right' => 'Use Right',
            'must_paid' => 'Must Paid',
            'istatus' => 'Istatus',
            'access_level' => 'Access Level',
            'paidst' => 'Paidst',
            'displaycolor' => 'Displaycolor',
            'price_lock' => 'Price Lock',
            'icode_guid' => 'Icode Guid',
            'ename' => 'Ename',
            'cost' => 'Cost',
            'income' => 'Income',
            'hos_guid' => 'Hos Guid',
            'hos_guid_ext' => 'Hos Guid Ext',
            'is_medication' => 'Is Medication',
            'use_paidst' => 'Use Paidst',
            'is_medsupply' => 'Is Medsupply',
            'sub_income' => 'Sub Income',
            'highcost' => 'Highcost',
            'oldcode' => 'Oldcode',
            'billcode' => 'Billcode',
            'billnumber' => 'Billnumber',
            'nhso_adp_type_id' => 'Nhso Adp Type ID',
            'nhso_adp_code' => 'Nhso Adp Code',
            'unitprice' => 'Unitprice',
            'displaycolor_focus' => 'Displaycolor Focus',
            'tpu_code_list' => 'Tpu Code List',
            'drugaccount' => 'Drugaccount',
        ];
    }
}
