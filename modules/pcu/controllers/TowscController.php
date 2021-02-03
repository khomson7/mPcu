<?php

namespace app\modules\pcu\controllers;

use app\config\components\AppController;
use app\modules\pcu\models\Opdconfig;
use app\modules\pcu\models\ReportLog;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `pcu` module
 */
class TowscController extends AppController
{

    protected function exec_hosxp_pcu($sql = null)
    {
        return \Yii::$app->db2->createCommand($sql)->execute();
    }

    protected function exec_master($sql = null)
    {
        return \Yii::$app->db->createCommand($sql)->execute();
    }

    public function actionIndex()
    {
                $ver = file_get_contents(Yii::getAlias('../version/version.txt'));
      //  $ver = explode(',', $ver);
       // echo $ver;

        $sql = "
               update chospital_amp set version = '$ver' where hoscode = '03149'
                ";
        $this->exec_master($sql);


        $basedata_id = '8';

        $sql = "select * from hos_basedata where id = '$basedata_id'";

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();

        foreach ($rawData as $data) {
            // $id = $data['id'];
            $base_data = $data['base_data'] . ' (' . $data['detail'] . ')';
        }

        $data = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => false,
        ]);

        return $this->render('index', [
            'data' => $data,
            'basedata_id' => $basedata_id,
            // 'id' => $id,
            'base_data' => $base_data,
        ]);
    }

    public function actionChospitalAmp()
    {


        $opd = Opdconfig::find()
            ->one();
        $pcu = $opd->hospitalcode;
        $url = Yii::$app->params['webservice'];
        $url2 = Yii::$app->params['pcuservice'];
        $user_id = \Yii::$app->user->identity->id;
        //ตรวจสอบสถานะ API
        try {
            $data_api0 = file_get_contents("$url");
            $json_api0 = json_decode($data_api0, true);
        } catch (\Exception $e) {
            return $this->redirect(['/site/api-err']);
        }

        $sql = "select token_ from wsc_check_token where id = '$user_id'";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        if (!$user_id) {
            throw new \Exception;
        }
        foreach ($data as $data) {
            $token_ = $data['token_'];
            $date_update = date('Y-m-d H:i:s');
            $sql = "UPDATE wsc_check_token  SET date_update = '$date_update' where id = '$user_id'";
            $this->exec_hosxp_pcu($sql);
        }
    
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url2/towscs/chospitalamp", //เปลี่ยนแปลง
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token_",
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);

        foreach ($data['data'] as $key => $item) {

            $moopart = $item['moopart'];
            $hoscode = $item['hoscode'];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url/pcutowscs/chospitalamp",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "PATCH",
                CURLOPT_POSTFIELDS => "{
                \"moopart\":\"$moopart\",
                \"hoscode\":\"$hoscode\"
                    }",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer $token_",
                    "Content-Type: application/json",
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

        }

        

        Yii::$app->getSession()->setFlash('success', 'ดำเนินการเรียบร้อยแล้ว!! ');

        return $this->redirect(['/pcu/default/index']);

    }

}
