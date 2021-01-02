<?php

namespace app\controllers;
use Yii;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;



class RcptreportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionReport1($date1 = null, $date2 = null) {


        if ($date1 == null) {
            $date1 = date('Y-m-d');
            $date2 = date('Y-m-d');
        }

        $sql = "
select vn,arrear_date,arrear_time,amount,staff,finance_number 
from base_rcpt_arrear
where date(d_update) BETWEEN '$date1' AND '$date2'

";


        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $person = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);


        return $this->render('report1', [
                    /* 'hospcode'=>$hospcode, */
                    'person' => $person,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2
                   
                   // 'main' => $main
        ]);
    }

}
