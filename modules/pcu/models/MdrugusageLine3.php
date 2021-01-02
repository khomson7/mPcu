<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "drugusage_line3".
 *
 * @property string $name
 * @property string $hos_guid
 * @property string $hos_guid_ext
 */
class MdrugusageLine3 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'drugusage_line3';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
  

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 250],
            [['hos_guid'], 'string', 'max' => 38],
            [['hos_guid_ext'], 'string', 'max' => 64],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'hos_guid' => 'Hos Guid',
            'hos_guid_ext' => 'Hos Guid Ext',
        ];
    }
}
