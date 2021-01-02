<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "tbl_token_sendline".
 *
 * @property int $id
 * @property int $username_id
 * @property int $send_id
 */
class TblSendline extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_token_sendline';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username_id', 'send_id'], 'integer'],
            [['hoscode'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username_id' => 'Username ID',
            'send_id' => 'Send ID',
            'hoscode' => 'Hoscode',
        ];
    }
}
