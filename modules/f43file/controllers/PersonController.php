<?php

namespace app\modules\f43file\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\pcu\models\Opdconfig;
use app\config\components\AppController;

class PersonController extends AppController {

    /**
     * {@inheritdoc}
     */
    /*
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
     * */


    protected function exec_hosxp_pcu($sql = NULL) {
        return \Yii::$app->db2->createCommand($sql)->execute();
    }

    public function actionTestroute() {
        
    }

    public function actionLoginapi() {

        $url = Yii::$app->params['webservice'];
        $user_id = Yii::$app->params['uid'];
        // $user_id = '10004';
        $sql = "select email ,
concat('##Ps',mid(username,1,2),mid(password_hash,1,7),'##') as mypassword from `user` where id = '$user_id'";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        if (!$user_id) {
            throw new \Exception;
        }
        foreach ($data as $data) {
            $email = $data['email'];
            $password = $data['mypassword'];
        }

        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url/userdbs/login2",
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_ENCODING => true,
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               URLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{\r\n\"email\":\"$email\",\r\n\"password\":\"$password\"\r\n}\r\n",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            ));


            $response = curl_exec($curl);

            $data = '{
    "success": 1,
    "data": [' . $response . ']
}';
            curl_close($curl);

            if (!$response) {
                //  return $this->redirect('api-error');
            }

            $json_api0 = json_decode($data, true);
            foreach ($json_api0['data'] as $value) {
                $token = $value['token'];

                $date_creat = date('Y-m-d H:i:s');

                $sql = "REPLACE INTO wsc_check_token(id,token_,date_creat)
                    VALUE('$user_id','$token','$date_creat')";
                $this->exec_hosxp_pcu($sql);
            }
            
            
            
            
        } catch (\Exception $e) {

            //echo "ท่านไม่ได้รับสิทธ";
            return $this->redirect(['/site/api-err']);
        }
    }

    public function actionWscDeath() {

        $url = Yii::$app->params['webservice'];

        $basedata_id = '2';

        $sql = "select * from hos_basedata where id = '$basedata_id'";

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();

        foreach ($rawData as $data) {
            $base_data = $data['base_data'] . ' (' . $data['detail'] . ')';
        }


        $user_id = Yii::$app->params['uid'];

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
        
        //เตรียมส่งข้อมูล Death
        try {
            $sql0 = "REPLACE INTO wsc_death_check(CID,PID,DISCHARGE,DDISCHARGE)
select t.CID,t.PID,t.DISCHARGE,t.DDISCHARGE FROM
(select p.cid as CID,LPAD(person_id, 6, '0') as PID,
person_discharge_id as DISCHARGE,death_date as DDISCHARGE,
CASE
WHEN(select CID from wsc_death_check WHERE CID = p.cid AND PID = p.person_id) is not null THEN 'Y' 
ELSE 'N' end as Check_status
from person p where death = 'Y' OR (death_date not in('') OR death_date is not null))t
WHERE t.Check_status = 'N'";
            $this->exec_hosxp_pcu($sql0);

              //ตรวจสอบข้อมูลที่ยังไม่ส่ง
            $sql = "select t.HOSPCODE,t.CID,t.PID,t.SEX,t.BIRTH,t.DISCHARGE,t.DDISCHARGE,t.D_UPDATE FROM 
(select (select hospitalcode from opdconfig) as HOSPCODE,p.cid as CID,LPAD(person_id, 6, '0') as PID,
p.sex as SEX,birthdate as BIRTH,person_discharge_id as DISCHARGE,death_date as DDISCHARGE,last_update as D_UPDATE
,MD5(concat('wsc',p.cid,LPAD(person_id, 6, '0'),p.person_discharge_id,ifnull('',p.death_date))) as deathcheck
,MD5(concat('wsc',p.cid)) as cids
from person p where death = 'Y' OR (death_date not in('') OR death_date is not null))t
INNER JOIN wsc_death_check t2 on ((t2.CID = t.CID AND t.PID = t2.PID)
AND t.deathcheck <> t2.apicheck)";
            $data = Yii::$app->db2->createCommand($sql)->queryAll();

            foreach ($data as $data) {
                $HOSPCODE = $data['HOSPCODE'];
                $CID = $data['CID'];
                $PID = $data['PID'];
                $SEX = $data['SEX'];
                $BIRTH = $data['BIRTH'];
                $DISCHARGE = $data['DISCHARGE'];
                $DDISCHARGE = $data['DDISCHARGE'];
                $D_UPDATE = $data['D_UPDATE'];

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$url/f43imports/death",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "{
                \"HOSPCODE\":\"$HOSPCODE\",
                \"CID\":\"$CID\",
                \"PID\":\"$PID\",
                \"SEX\":\"$SEX\",
                \"BIRTH\":\"$BIRTH\",
                \"DISCHARGE\":\"$DISCHARGE\",
                \"DDISCHARGE\":\"$DDISCHARGE\",
                \"D_UPDATE\":\"$D_UPDATE\"
                    }",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer $token_",
                        "Content-Type: application/json"
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);


                // echo $response;
            }

            $sql = "update wsc_death_check 
SET apicheck = MD5(concat('wsc',CID,PID,DISCHARGE,ifnull('',DDISCHARGE)))";
            $this->exec_hosxp_pcu($sql);
            //จบส่งข้อมูล Death
            
          //นำเข้าข้อมูลแพ้ยา  
            $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$url/persons/opdallergy", //เปลี่ยนแปลง
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
                        "Content-Type: application/json"
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                $data = json_decode($response, true);

                foreach ($data['data'] as $value) {
                    $hn = $value['hn'];
                    $report_date = $value['report_date'];
                    $agent = $value['agent'];
                    $symptom = $value['symptom2'];
                    $reporter = $value['reporter'];
                    $note = $value['note2'];
                    $begin_date = $value['begin_date_'];
                    $entry_datetime = $value['entry_datetime'];
                    $update_datetime = $value['update_datetime'];
                    $patient_cid = $value['patient_cid'];
                    $allergy_group_id = $value['allergy_group_id'];
                    $seriousness_id = $value['seriousness_id'];
                    $allergy_result_id = $value['allergy_result_id'];
                    $allergy_relation_id = $value['allergy_relation_id'];
                     $force_no_order = $value['force_no_order'];
                     $agent_code24 = $value['agent_code24'];
                     
                                     
                        $sql = "REPLACE INTO opd_allergy_10918(hn,report_date,agent,symptom,reporter,note,begin_date,entry_datetime,update_datetime
                            ,patient_cid,allergy_group_id,seriousness_id,allergy_result_id,allergy_relation_id,agent_code24)
                    VALUE('$hn','$report_date','$agent','$symptom','$reporter','$note','$begin_date','$entry_datetime','$update_datetime'
                                ,'$patient_cid','$allergy_group_id','$seriousness_id','$allergy_result_id','$allergy_relation_id','$agent_code24')";
                        $this->exec_hosxp_pcu($sql);
                    
                }

            $sql2 = "call mpcu_opd_allergy_importpcu";           
             $this->exec_hosxp_pcu($sql2);
            //จบนำเข้าข้อมูลแพ้ยา
    
        } catch (\Exception $e) {
            return $this->redirect(['/site/api-err']);
        }

         echo '<h4>ส่งข้อมูล '.'=> Death สำเร็จ</h4><hr>';
       // $this->notify_allergy('ทดสอบส่งข้อมูล');
    }

    public function notify_allergy($message) {

        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $rows = (new \yii\db\Query())
                ->select(['line_token'])
                ->from('chospital_amp')
                ->where('hoscode = :hoscode', [':hoscode' => $opdconfig])
                ->all();

        foreach ($rows as $rows) {

            $line_token = $rows['line_token'];

            $line_api = 'https://notify-api.line.me/api/notify';
            $queryData = array('message' => $message);
            $queryData = http_build_query($queryData, '', '&');

            $headerOptions = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                    . "Authorization: Bearer " . $line_token . "\r\n"
                    . "Content-Length: " . strlen($queryData) . "\r\n",
                    'content' => $queryData,
                ),
            );


            $context = stream_context_create($headerOptions);
            $result = file_get_contents($line_api, FALSE, $context);
        }
        $res = json_decode($result);
        return $res;
    }

}
