<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "opdconfig".
 *
 * @property string $anstartnumber
 * @property string $bankacc1
 * @property string $dtdepname
 * @property string $erdepcode
 * @property string $fbscode
 * @property string $hnstartnumber
 * @property string $hospitalname
 * @property string $hospitalcode
 * @property string $opddepcode
 * @property string $pcudepcode
 * @property string $ssdepname
 * @property string $screendepcode
 * @property string $searchopdcard
 * @property string $xraydepcode
 * @property int $lastreplicate
 * @property string $vn_stat
 * @property string $an_stat
 * @property string $rxdepname
 * @property string $rxdepcode
 * @property string $statroot
 * @property string $statsave
 * @property int $hn_style
 * @property string $sync_date
 * @property string $blob_server
 * @property string $ijs_hospcode
 * @property string $doctor_fee_icode
 * @property string $full_finance
 * @property string $vn_suffix
 * @property string $income_drug
 * @property string $income_nondrug
 * @property string $newdrugprofile
 * @property string $finance_depcode
 * @property string $announce
 * @property string $system_offline
 * @property string $offline_announce
 * @property string $hos_guid
 * @property string $hos_guid_ext
 * @property string $emergency_mode
 * @property string $last_upgrade_structure
 * @property string $no_bw_test
 * @property resource $app_icon_80x80_png
 * @property string $announce_html
 */
class Opdconfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opdconfig';
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
            [['hospitalcode'], 'required'],
            [['lastreplicate', 'hn_style'], 'integer'],
            [['sync_date', 'last_upgrade_structure'], 'safe'],
            [['announce', 'offline_announce', 'app_icon_80x80_png', 'announce_html'], 'string'],
            [['anstartnumber'], 'string', 'max' => 5],
            [['bankacc1', 'hospitalname', 'statroot'], 'string', 'max' => 50],
            [['dtdepname', 'ssdepname', 'rxdepname'], 'string', 'max' => 150],
            [['erdepcode', 'opddepcode', 'pcudepcode', 'screendepcode', 'xraydepcode', 'rxdepcode', 'finance_depcode'], 'string', 'max' => 3],
            [['fbscode', 'doctor_fee_icode'], 'string', 'max' => 7],
            [['hnstartnumber', 'hospitalcode', 'an_stat'], 'string', 'max' => 9],
            [['searchopdcard'], 'string', 'max' => 250],
            [['vn_stat'], 'string', 'max' => 13],
            [['statsave', 'full_finance', 'vn_suffix', 'newdrugprofile', 'system_offline', 'emergency_mode', 'no_bw_test'], 'string', 'max' => 1],
            [['blob_server', 'income_drug', 'income_nondrug'], 'string', 'max' => 20],
            [['ijs_hospcode'], 'string', 'max' => 12],
            [['hos_guid'], 'string', 'max' => 38],
            [['hos_guid_ext'], 'string', 'max' => 64],
            [['hospitalcode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'anstartnumber' => 'Anstartnumber',
            'bankacc1' => 'Bankacc1',
            'dtdepname' => 'Dtdepname',
            'erdepcode' => 'Erdepcode',
            'fbscode' => 'Fbscode',
            'hnstartnumber' => 'Hnstartnumber',
            'hospitalname' => 'Hospitalname',
            'hospitalcode' => 'Hospitalcode',
            'opddepcode' => 'Opddepcode',
            'pcudepcode' => 'Pcudepcode',
            'ssdepname' => 'Ssdepname',
            'screendepcode' => 'Screendepcode',
            'searchopdcard' => 'Searchopdcard',
            'xraydepcode' => 'Xraydepcode',
            'lastreplicate' => 'Lastreplicate',
            'vn_stat' => 'Vn Stat',
            'an_stat' => 'An Stat',
            'rxdepname' => 'Rxdepname',
            'rxdepcode' => 'Rxdepcode',
            'statroot' => 'Statroot',
            'statsave' => 'Statsave',
            'hn_style' => 'Hn Style',
            'sync_date' => 'Sync Date',
            'blob_server' => 'Blob Server',
            'ijs_hospcode' => 'Ijs Hospcode',
            'doctor_fee_icode' => 'Doctor Fee Icode',
            'full_finance' => 'Full Finance',
            'vn_suffix' => 'Vn Suffix',
            'income_drug' => 'Income Drug',
            'income_nondrug' => 'Income Nondrug',
            'newdrugprofile' => 'Newdrugprofile',
            'finance_depcode' => 'Finance Depcode',
            'announce' => 'Announce',
            'system_offline' => 'System Offline',
            'offline_announce' => 'Offline Announce',
            'hos_guid' => 'Hos Guid',
            'hos_guid_ext' => 'Hos Guid Ext',
            'emergency_mode' => 'Emergency Mode',
            'last_upgrade_structure' => 'Last Upgrade Structure',
            'no_bw_test' => 'No Bw Test',
            'app_icon_80x80_png' => 'App Icon 80x80 Png',
            'announce_html' => 'Announce Html',
        ];
    }
}
