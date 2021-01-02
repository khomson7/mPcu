<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "check_backup_log".
 *
 * @property string $idkey
 * @property string $hosp_code
 * @property string $ip
 * @property int $data_id
 * @property int $count_data
 * @property string $datetime
 * @property string $remark
 */
class CheckBackupLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'check_backup_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idkey'], 'required'],
            [['data_id', 'count_data'], 'integer'],
            [['datetime','datetime_send'], 'safe'],
            [['idkey'], 'string', 'max' => 30],
            [['hosp_code'], 'string', 'max' => 5],
            [['ip'], 'string', 'max' => 255],
            [['remark'], 'string', 'max' => 50],
            [['idkey'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idkey' => 'Idkey',
            'hosp_code' => 'Hosp Code',
            'ip' => 'Ip',
            'data_id' => 'Data ID',
            'count_data' => 'Count Data',
            'datetime' => 'Datetime',
            'datetime_send' => 'DatetimeSend',
            'remark' => 'Remark',
        ];
    }
}
