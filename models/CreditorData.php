<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "creditor_data".
 *
 * @property int $id ลำดับ
 * @property string $order_number เลขที่ใบสั่งซื้อ/จ้าง
 * @property string $parties คู่สัญญา
 * @property int $type_id ประเภทพัสดุ
 * @property string $receiver_number เลขที่ใบส่งของ
 * @property double $amount จำนวนเงิน
 * @property string $remark หมายเหตุ
 */
class CreditorData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'creditor_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id','type_id'], 'integer'],
            [['amount'], 'number'],
            [['remark'], 'string'],
            [['order_number', 'receiver_number'], 'string', 'max' => 20],
            [['parties'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ลำดับ',
            'order_number' => 'เลขที่ใบสั่งซื้อ/จ้าง',
            'parties' => 'คู่สัญญา',
            'type_id' => 'ประเภทพัสดุ',
            'receiver_number' => 'เลขที่ใบส่งของ',
            'amount' => 'จำนวนเงิน',
            'remark' => 'หมายเหตุ',
        ];
    }
}
