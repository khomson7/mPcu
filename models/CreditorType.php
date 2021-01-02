<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "creditor_type".
 *
 * @property int $id
 * @property string $creditor_type_name
 */
class CreditorType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'creditor_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creditor_type_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'creditor_type_name' => 'Creditor Type Name',
        ];
    }
}
