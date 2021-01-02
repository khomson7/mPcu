<?php

class Table1 extends ActiveRecord {
    public static function getDb()
    {
        return Yii::$app->db1;
    }

    public function getTable2()
    {
        return $this->hasMany(Table2::class, ['id' => 'id']);
    }
}

class Table2 extends ActiveRecord {
    public static function getDb()
    {
        return Yii::$app->db2;
    }
}

$query = Table1::find()->with('table2');