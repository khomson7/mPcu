<?php

namespace app\modules\pcu\models;

use Yii;


/**
 * This is the model class for table "wsc_pcu_oapp".
 *
 * @property int $id
 * @property string $hospcode
 * @property string $date_app
 * @property int $result
 */
class WscPcuOapp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wsc_pcu_oapp';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
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
            [['date_app','result'], 'required'],
            [['date_app','createdate','user_id','remark'], 'safe'],
            [['result'], 'integer'],
            [['hospcode'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hospcode' => 'Hospcode',
            'date_app' => 'วันที่นัด',
            'result' => 'จำนวนที่นัด(คน)',
            'user_id' => 'ผู้ใช้งาน',
            'createdate' => 'วันที่บันทึก',
            'remark' => 'หมายเหตุ',
        ];
    }
}
