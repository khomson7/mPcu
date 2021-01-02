<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rcpt_arrear".
 *
 * @property int $arrear_id
 * @property string $vn
 * @property string $arrear_date
 * @property string $arrear_time
 * @property double $amount
 * @property string $staff
 * @property string $rcpno
 * @property string $finance_number
 * @property string $paid
 * @property string $pt_type
 * @property string $hn
 * @property string $receive_money_date
 * @property string $receive_money_time
 * @property string $receive_money_staff
 * @property string $hos_guid
 * @property string $an
 */
class RcptArrear extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rcpt_arrear';
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
            [['arrear_id'], 'required'],
            [['arrear_id'], 'integer'],
            [['arrear_date', 'arrear_time', 'receive_money_date', 'receive_money_time'], 'safe'],
            [['amount'], 'number'],
            [['vn'], 'string', 'max' => 13],
            [['staff'], 'string', 'max' => 15],
            [['rcpno', 'finance_number', 'receive_money_staff'], 'string', 'max' => 50],
            [['paid'], 'string', 'max' => 1],
            [['pt_type'], 'string', 'max' => 3],
            [['hn', 'an'], 'string', 'max' => 9],
            [['hos_guid'], 'string', 'max' => 38],
            [['arrear_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'arrear_id' => 'Arrear ID',
            'vn' => 'Vn/An ',
            'arrear_date' => 'วันที่',
            'arrear_time' => 'เวลา',
            'amount' => 'Amount',
            'staff' => 'ผู้ดำเนินการ',
            'rcpno' => 'Rcpno',
            'finance_number' => 'Finance Number',
            'paid' => 'Paid',
            'pt_type' => 'Pt Type',
            'hn' => 'Hn',
            'receive_money_date' => 'Receive Money Date',
            'receive_money_time' => 'Receive Money Time',
            'receive_money_staff' => 'Receive Money Staff',
            'hos_guid' => 'Hos Guid',
            'an' => 'An',
        ];
    }
}
