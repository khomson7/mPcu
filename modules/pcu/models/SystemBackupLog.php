<?php

namespace app\modules\pcu\models;

use Yii;

/**
 * This is the model class for table "system_backup_log".
 *
 * @property int $backup_log_id
 * @property string $backup_datetime
 * @property string $backup_computer
 * @property string $backup_filename
 * @property double $backup_size
 */
class SystemBackupLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'system_backup_log';
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
            [['backup_log_id'], 'required'],
            [['backup_log_id'], 'integer'],
            [['backup_datetime'], 'safe'],
            [['backup_size'], 'number'],
            [['backup_computer'], 'string', 'max' => 50],
            [['backup_filename'], 'string', 'max' => 250],
            [['backup_log_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'backup_log_id' => 'Backup Log ID',
            'backup_datetime' => 'Backup Datetime',
            'backup_computer' => 'Backup Computer',
            'backup_filename' => 'Backup Filename',
            'backup_size' => 'Backup Size',
        ];
    }
}
