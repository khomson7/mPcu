<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hos_basedata".
 *
 * @property int $id
 * @property string $base_data
 * @property string $detail
 * @property string $link
 * @property string $active
 * @property int $count_report
 */
class HosBasedata extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hos_basedata';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['detail', 'active'], 'string'],
            [['count_report'], 'integer'],
            [['base_data'], 'string', 'max' => 255],
            [['link'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'base_data' => 'Base Data',
            'detail' => 'Detail',
            'link' => 'Link',
            'active' => 'Active',
            'count_report' => 'Count Report',
        ];
    }
}
