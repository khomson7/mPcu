<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "dttm".
 *
 * @property string $code
 * @property string $name
 * @property string $requiredtc
 * @property int $vorder
 * @property string $treatment
 * @property string $icd10
 * @property string $icd9cm
 * @property string $icode
 * @property double $opd_price1
 * @property double $opd_price2
 * @property double $opd_price3
 * @property double $ipd_price1
 * @property double $ipd_price2
 * @property double $ipd_price3
 * @property int $dttm_group_id
 * @property string $unit
 * @property string $charge_per_qty
 * @property string $active_status
 * @property string $dttm_guid
 * @property string $thai_name
 * @property string $charge_area_qty
 * @property int $dttm_subgroup_id
 * @property string $icd10tm_operation_code
 * @property int $dttm_dw_report_group_id
 * @property string $export_proced
 * @property string $dent2006_item_code
 * @property string $hos_guid
 */
class Dttm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dttm';
    }

    public static function getDb()
    {
        return Yii::$app->get('db2');
    }
    
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['vorder', 'dttm_group_id', 'dttm_subgroup_id', 'dttm_dw_report_group_id'], 'integer'],
            [['opd_price1', 'opd_price2', 'opd_price3', 'ipd_price1', 'ipd_price2', 'ipd_price3'], 'number'],
            [['code'], 'string', 'max' => 10],
            [['name', 'thai_name'], 'string', 'max' => 250],
            [['requiredtc', 'treatment', 'charge_per_qty', 'active_status', 'charge_area_qty', 'export_proced'], 'string', 'max' => 1],
            [['icd10', 'icd9cm'], 'string', 'max' => 9],
            [['icode'], 'string', 'max' => 7],
            [['unit'], 'string', 'max' => 20],
            [['dttm_guid', 'hos_guid'], 'string', 'max' => 38],
            [['icd10tm_operation_code'], 'string', 'max' => 15],
            [['dent2006_item_code'], 'string', 'max' => 50],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'name' => 'Name',
            'requiredtc' => 'Requiredtc',
            'vorder' => 'Vorder',
            'treatment' => 'Treatment',
            'icd10' => 'Icd10',
            'icd9cm' => 'Icd9cm',
            'icode' => 'Icode',
            'opd_price1' => 'Opd Price1',
            'opd_price2' => 'Opd Price2',
            'opd_price3' => 'Opd Price3',
            'ipd_price1' => 'Ipd Price1',
            'ipd_price2' => 'Ipd Price2',
            'ipd_price3' => 'Ipd Price3',
            'dttm_group_id' => 'Dttm Group ID',
            'unit' => 'Unit',
            'charge_per_qty' => 'Charge Per Qty',
            'active_status' => 'Active Status',
            'dttm_guid' => 'Dttm Guid',
            'thai_name' => 'Thai Name',
            'charge_area_qty' => 'Charge Area Qty',
            'dttm_subgroup_id' => 'Dttm Subgroup ID',
            'icd10tm_operation_code' => 'Icd10tm Operation Code',
            'dttm_dw_report_group_id' => 'Dttm Dw Report Group ID',
            'export_proced' => 'Export Proced',
            'dent2006_item_code' => 'Dent2006 Item Code',
            'hos_guid' => 'Hos Guid',
        ];
    }
}
