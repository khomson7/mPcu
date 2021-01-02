<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "chospital_amp".
 *
 * @property string $hoscode
 * @property string $hosname
 * @property string $hostype
 * @property string $address
 * @property string $road
 * @property string $mu
 * @property string $subdistcode
 * @property string $distcode
 * @property string $provcode
 * @property string $postcode
 * @property string $hoscodenew
 * @property string $bed จำนวนเตียง
 * @property string $level_service ระดับการบริการ
 * @property string $bedhos
 * @property int $hdc_regist
 * @property string $dep
 * @property string $hmain_sent
 * @property string $version
 * @property string $line_token
 * @property string $ip_serve
 */
class ChospitalAmp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chospital_amp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hdc_regist'], 'integer'],
            [['hoscode', 'postcode', 'bed', 'bedhos', 'dep', 'hmain_sent'], 'string', 'max' => 5],
            [['hosname', 'level_service', 'line_token'], 'string', 'max' => 255],
            [['hostype', 'mu', 'subdistcode', 'distcode', 'provcode'], 'string', 'max' => 2],
            [['address', 'road', 'version'], 'string', 'max' => 50],
            [['hoscodenew'], 'string', 'max' => 9],
            [['ip_serve'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'hoscode' => 'Hoscode',
            'hosname' => 'Hosname',
            'hostype' => 'Hostype',
            'address' => 'Address',
            'road' => 'Road',
            'mu' => 'Mu',
            'subdistcode' => 'Subdistcode',
            'distcode' => 'Distcode',
            'provcode' => 'Provcode',
            'postcode' => 'Postcode',
            'hoscodenew' => 'Hoscodenew',
            'bed' => 'จำนวนเตียง',
            'level_service' => 'ระดับการบริการ',
            'bedhos' => 'Bedhos',
            'hdc_regist' => 'Hdc Regist',
            'dep' => 'Dep',
            'hmain_sent' => 'Hmain Sent',
            'version' => 'Version',
            'line_token' => 'Line Token',
            'ip_serve' => 'Ip Serve',
        ];
    }
}
