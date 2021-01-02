<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "pk_byear".
 *
 * @property int $id
 * @property int $yearprocess
 * @property int $tyear
 */
class PkByear extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pk_byear';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['yearprocess', 'tyear'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'yearprocess' => 'Yearprocess',
            'tyear' => 'Tyear',
        ];
    }
}
