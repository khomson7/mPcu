<?php

namespace app\modules\f43file\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use aryelds\sweetalert\SweetAlert;

class OpdscreenController extends Controller {

    public $enableCsrfValidation = false;

    protected function exec_hosxp_pcu($sql = NULL) {
        return \Yii::$app->db2->createCommand($sql)->execute();
    }

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionSmoking() {

        $session = Yii::$app->session;
        $token = $session->get('mytoken');
        $session->open();

        $url = Yii::$app->params['webservice'];


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url/opdscreens/smoking",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        $data = json_decode($response, true);
        
        foreach ($data['results'] as $key => $item) {


            $smoking_type_id = $item['smoking_type_id'];
            $smoking_type_name = $item['smoking_type_name'];
            $nhso_code = $item['nhso_code'];


            $sql = "REPLACE INTO smoking_type(smoking_type_id,smoking_type_name,nhso_code)
            VALUE('$smoking_type_id','$smoking_type_name','$nhso_code')";
            $this->exec_hosxp_pcu($sql);

        }
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url/opdscreens/drinking",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        $data = json_decode($response, true);
        
        foreach ($data['results'] as $key => $item) {


            $drinking_type_id = $item['drinking_type_id'];
            $drinking_type_name = $item['drinking_type_name'];
            $nhso_code = $item['nhso_code'];


            $sql = "REPLACE INTO drinking_type(drinking_type_id,drinking_type_name,nhso_code)
            VALUE('$drinking_type_id','$drinking_type_name','$nhso_code')";
            $this->exec_hosxp_pcu($sql);

        }

       echo SweetAlert::widget([
    'options' => [
        'title' => "ปรับข้อมูลเรียบร้อยแล้ว!",
       // 'text' => "จำนวน => ".sizeof($data['data'])." Reccord ",
        'type' => SweetAlert::TYPE_SUCCESS
    ]
]);

        return $this->render('smoking');
    }

}
