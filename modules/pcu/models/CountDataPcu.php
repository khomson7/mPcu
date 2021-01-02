<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "count_data_pcu".
 *
 * @property int $id
 * @property string $hosp_code
 * @property string $ip
 * @property int $data_id
 * @property int $count_data
 * @property string $datetime
 * @property string $remark
 */
class CountDataPcu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'count_data_pcu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count_data'], 'integer'],
            [['datetime'], 'safe'],
            [['hosp_code'], 'string', 'max' => 5],
            [['ip'], 'string', 'max' => 255],
            [['remark','idkey'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idkey' => 'ID',
            'hosp_code' => 'Hosp Code',
            'ip' => 'Ip',
            'data_id' => 'Data ID',
            'count_data' => 'Count Data',
            'datetime' => 'Datetime',
            'remark' => 'Remark',
        ];
    }
}
