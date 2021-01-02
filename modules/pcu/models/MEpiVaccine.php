<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "epi_vaccine".
 *
 * @property int $epi_vaccine_id
 * @property string $epi_vaccine_name
 * @property string $vaccine_code
 * @property int $age_min
 * @property int $age_max
 * @property string $export_vaccine_code
 * @property string $vaccine_in_use
 * @property string $hos_guid
 * @property string $icode
 * @property double $price
 * @property string $combine_vaccine
 * @property string $check_code
 */
class MEpiVaccine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'epi_vaccine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['epi_vaccine_id'], 'required'],
            [['epi_vaccine_id', 'age_min', 'age_max'], 'integer'],
            [['price'], 'number'],
            [['epi_vaccine_name'], 'string', 'max' => 150],
            [['vaccine_code'], 'string', 'max' => 20],
            [['export_vaccine_code', 'check_code'], 'string', 'max' => 10],
            [['vaccine_in_use', 'combine_vaccine'], 'string', 'max' => 1],
            [['hos_guid'], 'string', 'max' => 38],
            [['icode'], 'string', 'max' => 7],
            [['epi_vaccine_name'], 'unique'],
            [['vaccine_code'], 'unique'],
            [['epi_vaccine_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'epi_vaccine_id' => 'Epi Vaccine ID',
            'epi_vaccine_name' => 'Epi Vaccine Name',
            'vaccine_code' => 'Vaccine Code',
            'age_min' => 'Age Min',
            'age_max' => 'Age Max',
            'export_vaccine_code' => 'Export Vaccine Code',
            'vaccine_in_use' => 'Vaccine In Use',
            'hos_guid' => 'Hos Guid',
            'icode' => 'Icode',
            'price' => 'Price',
            'combine_vaccine' => 'Combine Vaccine',
            'check_code' => 'Check Code',
        ];
    }
}
