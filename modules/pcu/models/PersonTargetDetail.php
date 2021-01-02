<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "person_target_detail".
 *
 * @property string $idkey
 * @property string $hospcode
 * @property string $b_year
 * @property int $person_target_index_id
 * @property int $male
 * @property int $female
 * @property int $type1
 * @property int $type2
 * @property int $type3
 * @property int $type4
 * @property int $all_target
 */
class PersonTargetDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person_target_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idkey'], 'required'],
            [['person_target_index_id', 'male', 'female', 'type1', 'type2', 'type3', 'type4', 'all_target', 'edit_in_year'], 'integer'],
            [['idkey'], 'string', 'max' => 30],
            [['hospcode', 'b_year'], 'string', 'max' => 5],
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
            'hospcode' => 'Hospcode',
            'b_year' => 'B Year',
            'person_target_index_id' => 'Person Target Index ID',
            'male' => 'Male',
            'female' => 'Female',
            'type1' => 'Type1',
            'type2' => 'Type2',
            'type3' => 'Type3',
            'type4' => 'Type4',
            'all_target' => 'All Target',
            'edit_in_year' => 'Edit In Year',
        ];
    }
}
