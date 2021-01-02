<?php

namespace app\models;

use Yii;
use yii\base\Model;

class PttypeChangeForm extends Model
{
    public $pttype_new;
     public $remark;
   


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            
            [['pttype_new'], 'required'],
            [['remark'],'string'],
            
        ];
    }
    
    public function attributeLabels()
    {
        return [
            
            'pttype_new' => 'สิทธการรักษาใหม่',
            'remark' => 'หมายเหตุ',
            
        ];
    }

   
}
