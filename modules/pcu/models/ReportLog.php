<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "report_log".
 *
 * @property int $id
 * @property int $user_id
 * @property string $ip
 * @property int $hosbase_sub_id
 * @property string $datetime
 * @property string $remark
 */
class ReportLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id','data_index_id'], 'integer'],
            [['datetime'], 'safe'],
            [['ip','code_data'], 'string', 'max' => 255],
            [['remark'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'ip' => 'Ip',
            'code_data' => 'CodeData',
            'datetime' => 'Datetime',
            'data_index_id' => 'DataIndexId',
            'remark' => 'Remark',
        ];
    }
}
