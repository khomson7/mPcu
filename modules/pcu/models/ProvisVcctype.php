<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "m_provis_vcctype".
 *
 * @property string $code
 * @property string $name
 * @property string $hos_guid
 */
class ProvisVcctype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provis_vcctype';
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
            [['code'], 'required'],
            [['code'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 150],
            [['hos_guid'], 'string', 'max' => 38],
            [['name'], 'unique'],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'name' => 'Name',
            'hos_guid' => 'Hos Guid',
        ];
    }
}
