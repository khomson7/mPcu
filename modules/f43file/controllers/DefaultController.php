<?php

namespace app\modules\f43file\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\pcureport\models\HosBasedata;
use app\modules\pcureport\models\HosBasedataSub;
use app\config\components\AppController;
use app\modules\pcu\models\ReportLog;
use app\modules\pcu\models\Opdconfig;
use aryelds\sweetalert\SweetAlert;

class DefaultController extends AppController {

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

    public function actionModify() {


        $url = Yii::$app->params['webservice'];
        $url2 = Yii::$app->params['pcuservice'];
        //ตรวจสอบสถานะ API
        try {
            $data_api0 = file_get_contents("$url");
            $json_api0 = json_decode($data_api0, true);
        } catch (\Exception $e) {
            return $this->redirect(['/site/api-err']);
        }

        $user_id = \Yii::$app->user->identity->id;

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

        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;


       $sql = file_get_contents(__DIR__ . '/sql/hos_smdr.sql');
        $command = Yii::$app->db2->createCommand($sql);
        $command->execute();

        // Make sure, we fetch all errors
        while ($command->pdoStatement->nextRowSet()) {}


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url/opdscreens/smdr/$opdconfig", //เปลี่ยนแปลง
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
              //  "Authorization: Bearer $token",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);


        $data = json_decode($response, true);
        // $datacount = sizeof($data['data']);
        // echo $datacount;

        foreach ($data['results'] as $key => $data) {

          //  $hos_guid = $data['hos_guid'];
            $vn = $data['vn'];
            $cid = $data['cid'];
            $chwpart = $data['chwpart'];
            $amppart = $data['amppart'];
            $tmbpart = $data['tmbpart'];
            $moopart = $data['moopart'];
            $vstdate = $data['vstdate'];
            $vsttime = $data['vsttime'];
            $drinking_type_id = $data['drinking_type_id'];
            $smoking_type_id = $data['smoking_type_id'];


            $sql = "REPLACE INTO hos_smdr(vn,cid,chwpart,amppart,tmbpart,moopart,vstdate,vsttime,drinking_type_id,smoking_type_id)
            VALUE('$vn','$cid','$chwpart','$amppart','$tmbpart','$moopart','$vstdate','$vsttime','$drinking_type_id','$smoking_type_id')";
            $this->exec_hosxp_pcu($sql);
        }

        Yii::$app->getSession()->setFlash('success', 'ดำเนินการเรียบร้อยแล้ว!! ');
        return $this->render('index');
//Yii::$app->getSession()->setFlash('success', 'ประมวลผลเรียบร้อยแล้ว!! ');
        //  return $this->redirect(['/site/process-success']);
    }

    public function actionSmDrPps($date1 = null, $date2 = null) {

             if ($date1 == null) {

            $date0 = date('Y-m-d');
            $date1 = $date0;
            $date2 = $date0;
        }

        $sql = "
select (@cnt := @cnt + 1) AS pp_special_id,tall.vn,t.pp_special_type_id,tall.doctor,'1' as pp_special_service_place_type_id
,date_format(DATE_ADD(concat(tall.vstdate,' ',tall.vsttime), INTERVAL 5 MINUTE),'%Y-%m-%d %H:%i:%s') as entry_datetime
,(select hospitalcode from opdconfig) as dest_hospcode,tall.hn
 FROM
(select o.vstdate,o.vsttime,o.vn,o.hn,t.smoking,(select doctorcode from opduser where loginname = o.staff) as doctor
FROM ovst o
INNER JOIN patient pt on pt.hn = o.hn
INNER JOIN
(select h.*,
CASE 
                        WHEN smoking_type_id in('1','17') THEN '1B52'
                        WHEN smoking_type_id in('10') THEN '1B501'
                        WHEN smoking_type_id in('11') THEN '1B502'
                        WHEN smoking_type_id in('12','13') THEN '1B503'
                        WHEN smoking_type_id in('14') THEN '1B542'
                        WHEN smoking_type_id in('15','16') THEN '1B562'
                        end as smoking 
FROM hos_smdr h
INNER JOIN
(select max(vn) as vn 
from hos_smdr GROUP BY cid)t on t.vn = h.vn)t on convert(t.cid using utf8) COLLATE utf8_general_ci =  convert(upper(md5(concat('r9',pt.cid,'refer#09'))) using utf8) COLLATE utf8_general_ci

WHERE o.vstdate BETWEEN '$date1' AND '$date2' AND t.smoking is not null

UNION

select o.vstdate,o.vsttime,o.vn,o.hn,t.drinking,(select doctorcode from opduser where loginname = o.staff) as doctor
FROM ovst o
INNER JOIN patient pt on pt.hn = o.hn
INNER JOIN
(select h.*,CASE 
                        WHEN drinking_type_id in('1','14') THEN '1B600'
                        WHEN drinking_type_id in('11','12','13') THEN '1B601'
                        WHEN drinking_type_id in('7') THEN '1B602'
                        WHEN drinking_type_id in('8') THEN '1B603'
                        WHEN drinking_type_id in('9','10') THEN '1B604'
                        end as drinking
FROM hos_smdr h
INNER JOIN
(select max(vn) as vn 
from hos_smdr GROUP BY cid)t on t.vn = h.vn)t on convert(t.cid using utf8) COLLATE utf8_general_ci =  convert(upper(md5(concat('r9',pt.cid,'refer#09'))) using utf8) COLLATE utf8_general_ci

WHERE o.vstdate BETWEEN '$date1' AND '$date2' AND t.drinking is not null)tall
LEFT JOIN pp_special_type t on convert(t.pp_special_code using utf8) COLLATE utf8_general_ci = tall.smoking
CROSS JOIN (SELECT @cnt := (select MAX(pp_special_id) FROM pp_special)) AS dummy
where tall.hn not in(select ps.hn from pp_special ps
                        INNER JOIN doctor d on d.code = ps.doctor
                        WHERE date(entry_datetime)> '2019-09-30'
                        AND pp_special_type_id in
                        (select pp_special_type_id from pp_special_type WHERE pp_special_code LIKE'1B5%' OR pp_special_code LIKE'1B6%')
                        AND hn is not NULL  
                        GROUP BY hn)
AND tall.smoking is not NULL
and tall.hn is not null and tall.doctor not in('')
ORDER BY tall.vn asc
";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $pp_special_id = $data['pp_special_id'];
            $vn = $data['vn'];
            $pp_special_type_id = $data['pp_special_type_id'];
            $doctor = $data['doctor'];
            $pp_special_service_place_type_id = $data['pp_special_service_place_type_id'];
            $entry_datetime = $data['entry_datetime'];
            $dest_hospcode = $data['dest_hospcode'];
            $hn = $data['hn'];

            $sql = "INSERT INTO pp_special(pp_special_id,vn,pp_special_type_id,doctor,pp_special_service_place_type_id,entry_datetime,dest_hospcode,hn)
            VALUE('$pp_special_id','$vn','$pp_special_type_id','$doctor','$pp_special_service_place_type_id',
            '$entry_datetime','$dest_hospcode','$hn')";
            $this->exec_hosxp_pcu($sql);
        }

        $sql2 = "UPDATE serial 
SET serial_no = (select MAX(pp_special_id) FROM pp_special)
WHERE `name` = 'pp_special_id'";
        $this->exec_hosxp_pcu($sql2);
        Yii::$app->getSession()->setFlash('success', 'ปรับข้อมูลเรียบร้อย!! ');

        return $this->render('sm-dr-pps', [
            'date1' => $date1,
            'date2' => $date2,
        ]);
    }

    public function actionEpi() {

        $opd = Opdconfig::find()
                ->one();
        $pcu = $opd->hospitalcode;
        $url = Yii::$app->params['webservice'];
        $url2 = Yii::$app->params['pcuservice'];

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
        
        $sql2 = "call mpcu_epi_send";
        $this->exec_hosxp_pcu($sql2);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url2/f43exports/epis", //เปลี่ยนแปลง
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

        foreach ($data['data'] as $key => $item) {

            $HOSPCODE = $item['HOSPCODE'];
            $PID = $item['PID'];
            $SEQ = $item['SEQ'];
            $DATE_SERV = $item['DATE_SERV'];
            $VACCINETYPE = $item['VACCINETYPE'];
            $VACCINEPLACE = $item['VACCINEPLACE'];
            $PROVIDER = $item['PROVIDER'];
            $D_UPDATE = $item['D_UPDATE'];
            $apicheck = $item['apicheck'];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url/f43imports/epi",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{
                \"HOSPCODE\":\"$HOSPCODE\",
                \"PID\":\"$PID\",
                \"SEQ\":\"$SEQ\",
                \"DATE_SERV\":\"$DATE_SERV\",
                \"VACCINETYPE\":\"$VACCINETYPE\",
                \"VACCINEPLACE\":\"$VACCINEPLACE\",
                \"PROVIDER\":\"$PROVIDER\",
                \"D_UPDATE\":\"$D_UPDATE\"
                    }",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer $token_",
                    "Content-Type: application/json"
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $sql = "update wsc_epi_check set check_status = '1'  where epikey = '$apicheck'";
            $this->exec_hosxp_pcu($sql);
        }

        $sql = "update wsc_epi_check set check_update = check_edit where check_status = '1' ";
        $this->exec_hosxp_pcu($sql);

        Yii::$app->getSession()->setFlash('success', 'ส่งข้อมูลเรียบร้อยแล้ว!! ');
        return $this->render('index');
    }

    public function actionOpdallergy() {

        $url = Yii::$app->params['webservice'];
        $url2 = Yii::$app->params['pcuservice'];


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

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url/persons/allergycheck", //เปลี่ยนแปลง
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


//   $datacount = sizeof($data['data']);
//  echo $response;


        foreach ($data['data'] as $key => $item) {


            $cid_encrypt2 = $item['cid_encrypt'];
            $check_edit2 = $item['check_edit'];


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url2/persons/cidencrypt",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{
                \"cid_encrypt\":\"$cid_encrypt2\",
                \"check_edit\":\"$check_edit2\"
                
                    }",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer $token_",
                    "Content-Type: application/json"
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
        }


        $sql = "select cid from patient WHERE  MD5(concat('wsc',cid)) in (select cid_encrypt from wsc_cid_encrypt)";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $cid = $data['cid'];


//  $last_check = date('Y-m-d H:i:s');
//  $sql = "REPLACE INTO wsc_check_patient(cid,last_check)
//       VALUE('$cid','$last_check')";
//   $this->exec_hosxp_pcu($sql);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url/persons/opdallergy/$cid", //เปลี่ยนแปลง
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


//   $datacount = sizeof($data['data']);
// echo $datacount;

            foreach ($data['data'] as $key => $item) {


                $hn = $item['hn'];
                $report_date = $item['report_date'];
                $agent = $item['agent'];
                $symptom = $item['symptom'];
                $reporter = $item['reporter'];
                $note = $item['note'];
                $allergy_group_id = $item['allergy_group_id'];
                $seriousness_id = $item['seriousness_id'];
                $allergy_result_id = $item['allergy_result_id'];
                $allergy_relation_id = $item['allergy_relation_id'];
                $patient_cid = $item['patient_cid'];
                $entry_datetime = $item['entry_datetime'];
                $update_datetime = $item['update_datetime'];
                $force_no_order = $item['force_no_order'];
                $opd_allergy_alert_type_id = $item['opd_allergy_alert_type_id'];
                $opd_allergy_source_id = $item['opd_allergy_source_id'];
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$url2/f43exports/opdallergy",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "{
                \"hn\":\"$hn\",
                \"report_date\":\"$report_date\",
                \"agent\":\"$agent\",
                \"symptom\":\"$symptom\",
                \"reporter\":\"$reporter\",
                \"note\":\"$note\",
                \"allergy_group_id\":\"$allergy_group_id\",
                \"seriousness_id\":\"$seriousness_id\",
                \"allergy_result_id\":\"$allergy_result_id\",
                \"allergy_relation_id\":\"$allergy_relation_id\",
                 \"patient_cid\":\"$patient_cid\",
                 \"entry_datetime\":\"$entry_datetime\",
                 \"update_datetime\":\"$update_datetime\",
                 \"force_no_order\":\"$force_no_order\",
                  \"opd_allergy_alert_type_id\":\"$opd_allergy_alert_type_id\",
                  \"opd_allergy_source_id\":\"$opd_allergy_source_id\"
                    }",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer $token_",
                        "Content-Type: application/json"
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
            }
        }


        $sql = "call mpcu_opd_allergy_importpcu";
        $this->exec_hosxp_pcu($sql);
    }

    public function actionWscopipcu() {

        $opd = Opdconfig::find()
                ->one();
        
        $pcu = $opd->hospitalcode;
        
        $url = Yii::$app->params['webservice'];
        $url2 = Yii::$app->params['pcuservice'];

     

       // $user_id = Yii::$app->params['uid'];
       $user_id = \Yii::$app->user->identity->id;

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
            CURLOPT_URL => "$url/opdscreens/pcudate/$pcu", //เปลี่ยนแปลง
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
        
      
        
        foreach ($data['data'] as $key => $item) {


            $date_work = $item['date_work'];
            $d_update = $item['d_update'];


            $sql = "REPLACE INTO wsc_t_work_pcu(date_work,d_update)
            VALUE('$date_work','$d_update')";
            $this->exec_hosxp_pcu($sql);
        }

  

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url2/wscopipcus/wsopipcu", //เปลี่ยนแปลง
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                //  "Authorization: Bearer $token_",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        

        foreach ($data['data'] as $key => $item) {


            $mkey = $item['mkey'];
            $hospcode = $item['hospcode'];
            $icode = $item['icode'];
            $name = $item['name'];
            $vn = $item['vn'];
            $mpid = $item['mpid'];
            $qty = $item['qty'];
            $vstdate = $item['vstdate'];
            $vsttime = $item['vsttime'];

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url/opitemreces/opitemrece",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{
                \"mkey\":\"$mkey\",
                \"hospcode\":\"$hospcode\",
                \"icode\":\"$icode\",
                \"name\":\"$name\",
                \"vn\":\"$vn\",
                \"mpid\":\"$mpid\",
                \"qty\":\"$qty\",
                \"vstdate\":\"$vstdate\",
                \"vsttime\":\"$vsttime\"        
                    }",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer $token_",
                    "Content-Type: application/json"
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $sql = "REPLACE INTO wsc_opitemrece_pcu_check(mkey)
            VALUE('$mkey')";
            $this->exec_hosxp_pcu($sql);
        }
        Yii::$app->getSession()->setFlash('success', 'ดำเนินการเรียบร้อยแล้ว!! ');

        return $this->redirect(['/pcu/default/index']);
        
    }

    public function actionWscperson() {

        $opd = Opdconfig::find()
                ->one();
        $pcu = $opd->hospitalcode;
        $url = Yii::$app->params['webservice'];
        $url2 = Yii::$app->params['pcuservice'];

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

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url2/f43exports/person", //เปลี่ยนแปลง
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

        foreach ($data['data'] as $key => $item) {

            $HOSPCODE = $item['HOSPCODE'];
            $CID = $item['CID'];
            $PID = $item['PID'];
            $HID = $item['HID'];
            $PRENAME = $item['PRENAME'];
            $NAME = $item['NAME'];
            $LNAME = $item['LNAME'];
            $HN = $item['HN'];
            $SEX = $item['SEX'];
            $BIRTH = $item['BIRTH'];
            $MSTATUS = $item['MSTATUS'];
            $OCCUPATION_OLD = $item['OCCUPATION_OLD'];
            $OCCUPATION_NEW = $item['OCCUPATION_NEW'];
            $RACE = $item['RACE'];
            $NATION = $item['NATION'];
            $RELIGION = $item['RELIGION'];
            $EDUCATION = $item['EDUCATION'];
            $FSTATUS = $item['FSTATUS'];
            $FATHER = $item['FATHER'];
            $MOTHER = $item['MOTHER'];
            $COUPLE = $item['COUPLE'];
            $VSTATUS = $item['VSTATUS'];
            $MOVEIN = $item['MOVEIN'];
            $DISCHARGE = $item['DISCHARGE'];
            $DDISCHARGE = $item['DDISCHARGE'];
            $ABOGROUP = $item['ABOGROUP'];
            $RHGROUP = $item['RHGROUP'];
            $LABOR = $item['LABOR'];
            $PASSPORT = $item['PASSPORT'];
            $TYPEAREA = $item['TYPEAREA'];
            $D_UPDATE = $item['D_UPDATE'];
            $person_id = $item['person_id'];

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url/persons",
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
                \"HID\":\"$HID\",
                \"PRENAME\":\"$PRENAME\",
                \"NAME\":\"$NAME\",
                \"LNAME\":\"$LNAME\",
                 \"HN\":\"$HN\",
                \"SEX\":\"$SEX\",
                \"BIRTH\":\"$BIRTH\",
                \"MSTATUS\":\"$MSTATUS\",
                \"OCCUPATION_OLD\":\"$OCCUPATION_OLD\",
                \"OCCUPATION_NEW\":\"$OCCUPATION_NEW\",
                \"RACE\":\"$RACE\",
                \"NATION\":\"$NATION\",
                \"RELIGION\":\"$RELIGION\",
                \"EDUCATION\":\"$EDUCATION\",
                \"FSTATUS\":\"$FSTATUS\",
                \"FATHER\":\"$FATHER\",
                \"MOTHER\":\"$MOTHER\",
                \"COUPLE\":\"$COUPLE\",
                \"VSTATUS\":\"$VSTATUS\",
                \"MOVEIN\":\"$MOVEIN\",
                \"DISCHARGE\":\"$DISCHARGE\",
                \"DDISCHARGE\":\"$DDISCHARGE\",
                \"ABOGROUP\":\"$ABOGROUP\",
                \"RHGROUP\":\"$RHGROUP\",
                \"LABOR\":\"$LABOR\",
                \"PASSPORT\":\"$PASSPORT\",
                \"TYPEAREA\":\"$TYPEAREA\",
                \"D_UPDATE\":\"$D_UPDATE\"
                    }",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer $token_",
                    "Content-Type: application/json"
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $sql = "update wsc_person_encrypt set check_status = '1'  where PID = '$person_id'";
            $this->exec_hosxp_pcu($sql);
        }

        $sql = "update wsc_person_encrypt set check_update = check_edit where check_status = '1' ";
        $this->exec_hosxp_pcu($sql);

        Yii::$app->getSession()->setFlash('success', 'ส่งข้อมูลเรียบร้อยแล้ว!! ');
        return $this->render('index');
    }
    
    


}
