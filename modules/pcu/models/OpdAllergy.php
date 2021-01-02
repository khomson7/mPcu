<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "opd_allergy".
 *
 * @property string $hn
 * @property string $report_date
 * @property string $agent
 * @property string $symptom
 * @property string $reporter
 * @property string $relation_level
 * @property string $note
 * @property string $allergy_type
 * @property int $display_order
 * @property string $begin_date
 * @property int $allergy_group_id
 * @property int $seriousness_id
 * @property int $allergy_result_id
 * @property int $allergy_relation_id
 * @property string $ward
 * @property string $department
 * @property string $spclty
 * @property string $entry_datetime
 * @property string $update_datetime
 * @property string $depcode
 * @property string $no_alert
 * @property int $naranjo_result_id
 * @property string $force_no_order
 * @property int $opd_allergy_alert_type_id
 * @property string $hos_guid
 * @property int $adr_preventable_score
 * @property string $preventable
 * @property string $patient_cid
 * @property int $adr_consult_dialog_id
 * @property int $opd_allergy_report_type_id
 * @property string $hos_guid_ext
 * @property string $agent_code24
 * @property string $officer_confirm
 * @property string $icode
 * @property int $opd_allergy_symtom_type_id
 * @property int $opd_allergy_id
 * @property string $cross_group_check
 * @property int $opd_allergy_source_id
 * @property int $opd_allergy_type_id
 * @property string $doctor_code
 */
class OpdAllergy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opd_allergy_10918';
    }

    
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
            [['hn', 'agent'], 'required'],
            [['report_date', 'begin_date', 'entry_datetime', 'update_datetime'], 'safe'],
            [['note'], 'string'],
            [['display_order', 'allergy_group_id', 'seriousness_id', 'allergy_result_id', 'allergy_relation_id', 'naranjo_result_id', 'opd_allergy_alert_type_id', 'adr_preventable_score', 'adr_consult_dialog_id', 'opd_allergy_report_type_id', 'opd_allergy_symtom_type_id', 'opd_allergy_id', 'opd_allergy_source_id', 'opd_allergy_type_id'], 'integer'],
            [['hn'], 'string', 'max' => 9],
            [['agent', 'symptom', 'reporter'], 'string', 'max' => 250],
            [['relation_level'], 'string', 'max' => 50],
            [['allergy_type', 'no_alert', 'force_no_order', 'preventable', 'officer_confirm', 'cross_group_check'], 'string', 'max' => 1],
            [['ward'], 'string', 'max' => 4],
            [['department', 'depcode'], 'string', 'max' => 3],
            [['spclty'], 'string', 'max' => 2],
            [['hos_guid'], 'string', 'max' => 38],
            [['patient_cid'], 'string', 'max' => 13],
            [['hos_guid_ext'], 'string', 'max' => 64],
            [['agent_code24'], 'string', 'max' => 24],
            [['icode'], 'string', 'max' => 7],
            [['doctor_code'], 'string', 'max' => 15],
            [['hn', 'agent'], 'unique', 'targetAttribute' => ['hn', 'agent']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'hn' => 'Hn',
            'report_date' => 'Report Date',
            'agent' => 'Agent',
            'symptom' => 'Symptom',
            'reporter' => 'Reporter',
            'relation_level' => 'Relation Level',
            'note' => 'Note',
            'allergy_type' => 'Allergy Type',
            'display_order' => 'Display Order',
            'begin_date' => 'Begin Date',
            'allergy_group_id' => 'Allergy Group ID',
            'seriousness_id' => 'Seriousness ID',
            'allergy_result_id' => 'Allergy Result ID',
            'allergy_relation_id' => 'Allergy Relation ID',
            'ward' => 'Ward',
            'department' => 'Department',
            'spclty' => 'Spclty',
            'entry_datetime' => 'Entry Datetime',
            'update_datetime' => 'Update Datetime',
            'depcode' => 'Depcode',
            'no_alert' => 'No Alert',
            'naranjo_result_id' => 'Naranjo Result ID',
            'force_no_order' => 'Force No Order',
            'opd_allergy_alert_type_id' => 'Opd Allergy Alert Type ID',
            'hos_guid' => 'Hos Guid',
            'adr_preventable_score' => 'Adr Preventable Score',
            'preventable' => 'Preventable',
            'patient_cid' => 'Patient Cid',
            'adr_consult_dialog_id' => 'Adr Consult Dialog ID',
            'opd_allergy_report_type_id' => 'Opd Allergy Report Type ID',
            'hos_guid_ext' => 'Hos Guid Ext',
            'agent_code24' => 'Agent Code24',
            'officer_confirm' => 'Officer Confirm',
            'icode' => 'Icode',
            'opd_allergy_symtom_type_id' => 'Opd Allergy Symtom Type ID',
            'opd_allergy_id' => 'Opd Allergy ID',
            'cross_group_check' => 'Cross Group Check',
            'opd_allergy_source_id' => 'Opd Allergy Source ID',
            'opd_allergy_type_id' => 'Opd Allergy Type ID',
            'doctor_code' => 'Doctor Code',
        ];
    }
}
