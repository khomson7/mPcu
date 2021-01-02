<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_vn_stat".
 *
 * @property string $vn
 * @property string $hn
 * @property string $pttype
 * @property string $vstdate
 */
class TestVnStat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vn_stat';
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
            [['vstdate'], 'safe'],
            [['vn'], 'string', 'max' => 15],
            [['hn'], 'string', 'max' => 9],
            [['pttype'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'vn' => 'Vn',
            'hn' => 'Hn',
            'pttype' => 'สิทธการรักษา',
            'vstdate' => 'วันที่รับบริการ',
        ];
    }
}
