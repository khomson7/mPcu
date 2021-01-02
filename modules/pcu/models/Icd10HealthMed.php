<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "icd10_health_med".
 *
 * @property string $icd10
 * @property string $name
 * @property string $hos_guid
 * @property string $hos_guid_ext
 */
class Icd10HealthMed extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'icd10_health_med';
    }

    public static function getDb()
    {
        return Yii::$app->get('db2');
    }
    
    public function rules()
    {
        return [
            [['icd10'], 'required'],
            [['icd10'], 'string', 'max' => 9],
            [['name'], 'string', 'max' => 150],
            [['hos_guid'], 'string', 'max' => 38],
            [['hos_guid_ext'], 'string', 'max' => 64],
            [['name'], 'unique'],
            [['icd10'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'icd10' => 'Icd10',
            'name' => 'Name',
            'hos_guid' => 'Hos Guid',
            'hos_guid_ext' => 'Hos Guid Ext',
        ];
    }
}
