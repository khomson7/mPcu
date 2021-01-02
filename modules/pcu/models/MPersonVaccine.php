<?php

namespace app\modules\pcu\models;


use Yii;
use app\modules\pcu\models\PersonVaccine;
//use app\modules\pcu\models\PersonVaccine;

/**
 * This is the model class for table "m_person_vaccine".
 *
 * @property int $person_vaccine_id
 * @property string $vaccine_name
 * @property string $vaccine_code
 * @property string $vaccine_group
 * @property string $export_vaccine_code
 * @property string $hos_guid
 * @property string $combine_vaccine
 * @property string $icode
 */
class MPersonVaccine extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'person_vaccine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['person_vaccine_id'], 'required'],
                [['person_vaccine_id'], 'integer'],
                [['vaccine_name'], 'string', 'max' => 150],
                [['vaccine_code', 'vaccine_group'], 'string', 'max' => 20],
                [['export_vaccine_code'], 'string', 'max' => 10],
                [['hos_guid'], 'string', 'max' => 38],
                [['combine_vaccine'], 'string', 'max' => 1],
                [['icode'], 'string', 'max' => 7],
                [['vaccine_name'], 'unique'],
                [['person_vaccine_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'person_vaccine_id' => 'Person Vaccine ID',
            'vaccine_name' => 'Vaccine Name',
            'vaccine_code' => 'Vaccine Code',
            'vaccine_group' => 'Vaccine Group',
            'export_vaccine_code' => 'Export Vaccine Code',
            'hos_guid' => 'Hos Guid',
            'combine_vaccine' => 'Combine Vaccine',
            'icode' => 'Icode',
        ];
    }
    
  public function getPvaccine() {
        return $this->hasOne(PersonVaccine::className(), ['vaccine_code' => 'vaccine_code']);
    }
    
}

class Pvaccine extends \yii\db\ActiveRecord {

   public static function getDb()
    {
        return Yii::$app->get('db2');
    }


}
