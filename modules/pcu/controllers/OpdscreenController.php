<?php

namespace app\modules\pcu\controllers;

use Yii;
use yii\web\Controller;
use app\modules\pcureport\models\HosBasedata;
use app\modules\pcureport\models\HosBasedataSub;
use app\config\components\AppController;
use app\modules\pcu\models\ReportLog;
use app\modules\pcu\models\Opdconfig;
use aryelds\sweetalert\SweetAlert;

class OpdscreenController extends AppController {

    protected function exec_hosxp_pcu($sql = NULL) {
        return \Yii::$app->db2->createCommand($sql)->execute();
    }

    public function actionOpd1($date1 = null, $date2 = null) {

        $session = Yii::$app->session;
        $token = $session->get('mytoken');
       // $session->open();

        if ($date1 == null) {
            //$date1 = date('2019-01-10');

            $date1 = date('Y-m-d');
            $date2 = date('Y-m-d');
        }

        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;


         $url = Yii::$app->params['webservice'];
         
       

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url/opdscreens/smdr/$opdconfig/$date1/$date2", //เปลี่ยนแปลง
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        

        $data = json_decode($response, true);
        // $datacount = sizeof($data['data']);
        // echo $datacount;

        foreach ($data['results'] as $key => $data) {

            $hos_guid = $data['hos_guid'];
            $hn = $data['hn'];
            $cid = $data['cid'];
            $chwpart = $data['chwpart'];
            $amppart = $data['amppart'];
            $tmbpart = $data['tmbpart'];
            $moopart = $data['moopart'];
            $vstdate = $data['vstdate'];
            $vsttime = $data['vsttime'];
            $drinking_type_id = $data['drinking_type_id'];
            $smoking_type_id = $data['smoking_type_id'];


            $sql = "REPLACE INTO hos_smdr(hos_guid,hn,cid,chwpart,amppart,tmbpart,moopart,vstdate,vsttime,drinking_type_id,smoking_type_id)
            VALUE('$hos_guid','$hn','$cid','$chwpart','$amppart','$tmbpart','$moopart','$vstdate','$vsttime','$drinking_type_id','$smoking_type_id')";
            $this->exec_hosxp_pcu($sql);
        }


        return $this->render('opd1', [
                    'date1' => $date1,
                    'date2' => $date2
        ]);
    }

    public function actionModify() {

        $sql = "ALTER TABLE person ADD COLUMN IF NOT EXISTS `apicheck` varchar(35) CHARACTER SET utf8 DEFAULT ''";
        $this->exec_hosxp_pcu($sql);
        
          $sql1 = "CREATE TABLE IF NOT EXISTS hos_smdr (
  hos_guid varchar(38) CHARACTER SET tis620 NOT NULL,
  hn varchar(9) CHARACTER SET tis620 DEFAULT NULL,
  cid varchar(13) CHARACTER SET tis620 DEFAULT NULL,
  chwpart char(2) CHARACTER SET tis620 DEFAULT NULL,
  amppart char(2) CHARACTER SET tis620 DEFAULT NULL,
  tmbpart char(2) CHARACTER SET tis620 DEFAULT NULL,
  moopart char(3) CHARACTER SET tis620 DEFAULT NULL,
  vstdate date DEFAULT NULL,
  vsttime time DEFAULT NULL,
  drinking_type_id int(11) DEFAULT NULL,
  smoking_type_id int(11) DEFAULT NULL,
  PRIMARY KEY (hos_guid)
) ENGINE=InnoDB DEFAULT CHARSET=tis620";
        $this->exec_hosxp_pcu($sql1);

Yii::$app->getSession()->setFlash('success', 'ประมวลผลเรียบร้อยแล้ว!! ');

        return $this->redirect(['/site/process-success']);
    }

}
