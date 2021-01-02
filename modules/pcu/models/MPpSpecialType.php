<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "pp_special_type".
 *
 * @property int $pp_special_type_id
 * @property string $pp_special_type_name
 * @property string $hos_guid
 * @property string $pp_special_code
 */
class MPpSpecialType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pp_special_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pp_special_type_id'], 'required'],
            [['pp_special_type_id'], 'integer'],
            [['pp_special_type_name'], 'string', 'max' => 200],
            [['hos_guid'], 'string', 'max' => 38],
            [['pp_special_code'], 'string', 'max' => 6],
            [['pp_special_type_name'], 'unique'],
            [['pp_special_type_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pp_special_type_id' => 'Pp Special Type ID',
            'pp_special_type_name' => 'Pp Special Type Name',
            'hos_guid' => 'Hos Guid',
            'pp_special_code' => 'Pp Special Code',
        ];
    }
}
