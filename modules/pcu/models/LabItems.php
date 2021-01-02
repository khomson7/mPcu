<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "lab_items".
 *
 * @property int $lab_items_code
 * @property string $lab_items_name
 * @property int $lab_type_code
 * @property string $lab_items_unit
 * @property string $lab_items_normal_value
 * @property string $lab_items_hint
 * @property string $lab_items_default_value
 * @property int $lab_items_group
 * @property double $service_price
 * @property string $possible_value
 * @property string $lab_routine
 * @property string $icode
 * @property int $lab_items_sub_group_code
 * @property string $require_specimen
 * @property int $specimen_code
 * @property int $wait_hour
 * @property string $critical_value
 * @property int $display_order
 * @property string $ecode
 * @property double $service_price2
 * @property double $service_price3
 * @property double $service_price_ipd
 * @property double $service_price_ipd2
 * @property double $service_price_ipd3
 * @property string $check_user
 * @property string $sub_group_list
 * @property string $range_check
 * @property double $range_check_min
 * @property double $range_check_max
 * @property int $result_type
 * @property double $range_check_min_female
 * @property double $range_check_max_female
 * @property string $lab_items_code_guid
 * @property double $service_cost
 * @property string $oldcode
 * @property string $items_is_outlab
 * @property string $hos_guid
 * @property string $report_edit_style
 * @property int $memo_line_count
 * @property string $alert_critical_value
 * @property double $critical_range_min_male
 * @property double $critical_range_min_female
 * @property double $critical_range_max_male
 * @property double $critical_range_max_female
 * @property string $confirm_order_text
 * @property string $loinc_code
 * @property string $check_result_by_age
 * @property string $check_history
 * @property int $check_history_day
 * @property string $lab_items_display_name
 * @property string $hint_text
 * @property int $lab_critical_alert_type_id
 * @property string $active_status
 * @property string $labtest
 * @property string $protect_result_by_user
 * @property string $protect_result_by_group
 * @property string $explicit_show_hist_abn_value
 * @property string $provis_labcode
 * @property string $alert_critical_value2
 * @property double $critical_range_min_male2
 * @property double $critical_range_min_female2
 * @property double $critical_range_max_male2
 * @property double $critical_range_max_female2
 * @property string $gen_order_no
 * @property string $gen_order_prefix
 * @property int $est_wait_minute
 * @property string $report_next_day
 * @property string $show_refer_doc
 */
class LabItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lab_items';
    }

      public static function getDb()
    {
        return Yii::$app->get('db2');
    }
    public function rules()
    {
        return [
            [['lab_items_code'], 'required'],
            [['lab_items_code', 'lab_type_code', 'lab_items_group', 'lab_items_sub_group_code', 'specimen_code', 'wait_hour', 'display_order', 'result_type', 'memo_line_count', 'check_history_day', 'lab_critical_alert_type_id', 'est_wait_minute'], 'integer'],
            [['service_price', 'service_price2', 'service_price3', 'service_price_ipd', 'service_price_ipd2', 'service_price_ipd3', 'range_check_min', 'range_check_max', 'range_check_min_female', 'range_check_max_female', 'service_cost', 'critical_range_min_male', 'critical_range_min_female', 'critical_range_max_male', 'critical_range_max_female', 'critical_range_min_male2', 'critical_range_min_female2', 'critical_range_max_male2', 'critical_range_max_female2'], 'number'],
            [['possible_value', 'hint_text'], 'string'],
            [['lab_items_name', 'lab_items_hint', 'lab_items_default_value', 'sub_group_list', 'confirm_order_text'], 'string', 'max' => 250],
            [['lab_items_unit', 'lab_items_normal_value', 'oldcode'], 'string', 'max' => 150],
            [['lab_routine', 'require_specimen', 'check_user', 'range_check', 'items_is_outlab', 'alert_critical_value', 'check_result_by_age', 'check_history', 'active_status', 'protect_result_by_user', 'protect_result_by_group', 'explicit_show_hist_abn_value', 'gen_order_no', 'report_next_day', 'show_refer_doc'], 'string', 'max' => 1],
            [['icode', 'provis_labcode'], 'string', 'max' => 7],
            [['critical_value'], 'string', 'max' => 100],
            [['ecode'], 'string', 'max' => 10],
            [['lab_items_code_guid', 'hos_guid'], 'string', 'max' => 38],
            [['report_edit_style'], 'string', 'max' => 25],
            [['loinc_code'], 'string', 'max' => 15],
            [['lab_items_display_name'], 'string', 'max' => 200],
            [['labtest', 'alert_critical_value2'], 'string', 'max' => 2],
            [['gen_order_prefix'], 'string', 'max' => 5],
            [['lab_items_code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lab_items_code' => 'Lab Items Code',
            'lab_items_name' => 'Lab Items Name',
            'lab_type_code' => 'Lab Type Code',
            'lab_items_unit' => 'Lab Items Unit',
            'lab_items_normal_value' => 'Lab Items Normal Value',
            'lab_items_hint' => 'Lab Items Hint',
            'lab_items_default_value' => 'Lab Items Default Value',
            'lab_items_group' => 'Lab Items Group',
            'service_price' => 'Service Price',
            'possible_value' => 'Possible Value',
            'lab_routine' => 'Lab Routine',
            'icode' => 'Icode',
            'lab_items_sub_group_code' => 'Lab Items Sub Group Code',
            'require_specimen' => 'Require Specimen',
            'specimen_code' => 'Specimen Code',
            'wait_hour' => 'Wait Hour',
            'critical_value' => 'Critical Value',
            'display_order' => 'Display Order',
            'ecode' => 'Ecode',
            'service_price2' => 'Service Price2',
            'service_price3' => 'Service Price3',
            'service_price_ipd' => 'Service Price Ipd',
            'service_price_ipd2' => 'Service Price Ipd2',
            'service_price_ipd3' => 'Service Price Ipd3',
            'check_user' => 'Check User',
            'sub_group_list' => 'Sub Group List',
            'range_check' => 'Range Check',
            'range_check_min' => 'Range Check Min',
            'range_check_max' => 'Range Check Max',
            'result_type' => 'Result Type',
            'range_check_min_female' => 'Range Check Min Female',
            'range_check_max_female' => 'Range Check Max Female',
            'lab_items_code_guid' => 'Lab Items Code Guid',
            'service_cost' => 'Service Cost',
            'oldcode' => 'Oldcode',
            'items_is_outlab' => 'Items Is Outlab',
            'hos_guid' => 'Hos Guid',
            'report_edit_style' => 'Report Edit Style',
            'memo_line_count' => 'Memo Line Count',
            'alert_critical_value' => 'Alert Critical Value',
            'critical_range_min_male' => 'Critical Range Min Male',
            'critical_range_min_female' => 'Critical Range Min Female',
            'critical_range_max_male' => 'Critical Range Max Male',
            'critical_range_max_female' => 'Critical Range Max Female',
            'confirm_order_text' => 'Confirm Order Text',
            'loinc_code' => 'Loinc Code',
            'check_result_by_age' => 'Check Result By Age',
            'check_history' => 'Check History',
            'check_history_day' => 'Check History Day',
            'lab_items_display_name' => 'Lab Items Display Name',
            'hint_text' => 'Hint Text',
            'lab_critical_alert_type_id' => 'Lab Critical Alert Type ID',
            'active_status' => 'Active Status',
            'labtest' => 'Labtest',
            'protect_result_by_user' => 'Protect Result By User',
            'protect_result_by_group' => 'Protect Result By Group',
            'explicit_show_hist_abn_value' => 'Explicit Show Hist Abn Value',
            'provis_labcode' => 'Provis Labcode',
            'alert_critical_value2' => 'Alert Critical Value2',
            'critical_range_min_male2' => 'Critical Range Min Male2',
            'critical_range_min_female2' => 'Critical Range Min Female2',
            'critical_range_max_male2' => 'Critical Range Max Male2',
            'critical_range_max_female2' => 'Critical Range Max Female2',
            'gen_order_no' => 'Gen Order No',
            'gen_order_prefix' => 'Gen Order Prefix',
            'est_wait_minute' => 'Est Wait Minute',
            'report_next_day' => 'Report Next Day',
            'show_refer_doc' => 'Show Refer Doc',
        ];
    }
    
     
}
