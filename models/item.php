<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use hauntd\vote\behaviors\VoteBehavior;

class Item extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%item}}';
    }

    public function behaviors()
    {
        return [
            VoteBehavior::class, // add VoteBehavior class to your model
        ];
    }

    public static function find()
    {
        return new ItemQuery(get_called_class()); // override find() method
    }
}