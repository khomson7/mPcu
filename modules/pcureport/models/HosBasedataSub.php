<?php

namespace app\modules\pcureport\models;

use Yii;

/**
 * This is the model class for table "hos_basedata_sub".
 *
 * @property int $id
 * @property int $basedata_id
 * @property string $basedata_sub_name
 * @property string $detail
 * @property string $link
 * @property string $link2
 * @property string $active
 * @property int $count_report
 */
class HosBasedataSub extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hos_basedata_sub';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['basedata_id', 'count_report'], 'integer'],
            [['detail', 'active'], 'string'],
            [['basedata_sub_name'], 'string', 'max' => 200],
            [['link', 'link2'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'basedata_id' => 'Basedata ID',
            'basedata_sub_name' => 'Basedata Sub Name',
            'detail' => 'Detail',
            'link' => 'Link',
            'link2' => 'Link2',
            'active' => 'Active',
            'count_report' => 'Count Report',
        ];
    }
}
