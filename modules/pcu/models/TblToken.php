<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "tbl_token".
 *
 * @property int $id
 * @property int $username_id
 * @property string $token_
 * @property int $user_access_group ชื่อผู้ที่ใช้กลุ่มนี้
 * @property string $group_name ชื่อกลุ่ม(ตั้งให้ตรงกับกลุ่ม Line ที่ต้องการส่งหา)
 * @property string $group_status สถานะเป็นกลุ่ม
 * @property string $department_id
 * @property string $active
 */
class TblToken extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username_id', 'user_access_group'], 'integer'],
            [['token_'], 'required'],
            [['group_status', 'active'], 'string'],
            [['token_', 'group_name'], 'string', 'max' => 255],
            [['department_id'], 'string', 'max' => 3],
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
            'token_' => 'Token',
            'user_access_group' => 'ชื่อผู้ที่ใช้กลุ่มนี้',
            'group_name' => 'ชื่อกลุ่ม(ตั้งให้ตรงกับกลุ่ม Line ที่ต้องการส่งหา)',
            'group_status' => 'สถานะเป็นกลุ่ม',
            'department_id' => 'Department ID',
            'active' => 'Active',
        ];
    }
}
