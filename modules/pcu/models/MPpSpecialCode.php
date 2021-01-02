<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "pp_special_code".
 *
 * @property string $code
 * @property string $name
 * @property string $pp_special_code_group
 * @property string $pp_special_code_subgroup
 */
class MPpSpecialCode extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pp_special_code';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code'], 'string', 'max' => 6],
            [['name'], 'string', 'max' => 250],
            [['pp_special_code_group'], 'string', 'max' => 1],
            [['pp_special_code_subgroup'], 'string', 'max' => 2],
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
            'pp_special_code_group' => 'Pp Special Code Group',
            'pp_special_code_subgroup' => 'Pp Special Code Subgroup',
        ];
    }
}
