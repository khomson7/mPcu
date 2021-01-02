<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "wbc_vaccine".
 *
 * @property int $wbc_vaccine_id
 * @property string $wbc_vaccine_name
 * @property string $wbc_vaccine_code
 * @property int $age_min
 * @property int $age_max
 * @property string $export_vaccine_code
 * @property string $check_code
 * @property string $vaccine_in_use
 * @property string $hos_guid
 * @property string $icode
 * @property double $price
 * @property string $combine_vaccine
 */
class MWbcVaccine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wbc_vaccine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wbc_vaccine_id'], 'required'],
            [['wbc_vaccine_id', 'age_min', 'age_max'], 'integer'],
            [['price'], 'number'],
            [['wbc_vaccine_name'], 'string', 'max' => 150],
            [['wbc_vaccine_code'], 'string', 'max' => 20],
            [['export_vaccine_code', 'check_code'], 'string', 'max' => 10],
            [['vaccine_in_use', 'combine_vaccine'], 'string', 'max' => 1],
            [['hos_guid'], 'string', 'max' => 38],
            [['icode'], 'string', 'max' => 7],
            [['wbc_vaccine_name'], 'unique'],
            [['wbc_vaccine_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'wbc_vaccine_id' => 'Wbc Vaccine ID',
            'wbc_vaccine_name' => 'Wbc Vaccine Name',
            'wbc_vaccine_code' => 'Wbc Vaccine Code',
            'age_min' => 'Age Min',
            'age_max' => 'Age Max',
            'export_vaccine_code' => 'Export Vaccine Code',
            'check_code' => 'Check Code',
            'vaccine_in_use' => 'Vaccine In Use',
            'hos_guid' => 'Hos Guid',
            'icode' => 'Icode',
            'price' => 'Price',
            'combine_vaccine' => 'Combine Vaccine',
        ];
    }
}
