<?php

namespace app\models;

use hauntd\vote\behaviors\VoteQueryBehavior;

class ItemQuery extends \yii\db\ActiveQuery
{
    public function behaviors()
    {
        return [
            VoteQueryBehavior::class,
        ];
    }
}