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

        $session = Yii::$app->session;
        $token = $session->get('mytoken');
        $session->open();

        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;


        $url = Yii::$app->params['webservice'];
/*
        $sql = "ALTER TABLE person ADD COLUMN IF NOT EXISTS `apicheck` varchar(35) CHARACTER SET utf8 DEFAULT ''";
        $this->exec_hosxp_pcu($sql);
*/
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

        Yii::$app->getSession()->setFlash('success', 'ดำเนินการเรียบร้อยแล้ว!! ');
        return $this->render('index');
//Yii::$app->getSession()->setFlash('success', 'ประมวลผลเรียบร้อยแล้ว!! ');
        //  return $this->redirect(['/site/process-success']);
    }

    public function actionSmDrPps() {
        $sql = "
select (@cnt := @cnt + 1) AS pp_special_id,tall.vn,t.pp_special_type_id,tall.doctor,'1' as pp_special_service_place_type_id
,date_format(DATE_ADD(concat(tall.vstdate,' ',tall.vsttime), INTERVAL 5 MINUTE),'%Y-%m-%d %H:%i:%s') as entry_datetime
,(select hospitalcode from opdconfig) as dest_hospcode,tall.hn 
 FROM
(select * FROM
(select ov.vstdate,ov.vsttime,t.*,(select doctorcode from opduser where loginname = ov.staff) as doctor 
,CASE 
                        WHEN smoking_type_id in('1','17') THEN '1B52'
                        WHEN smoking_type_id in('10') THEN '1B501'
                        WHEN smoking_type_id in('11') THEN '1B502'
                        WHEN smoking_type_id in('12','13') THEN '1B503'
                        WHEN smoking_type_id in('14') THEN '1B542'
                        WHEN smoking_type_id in('15','16') THEN '1B562'
                        end as smoking
FROM ovst ov
INNER JOIN
(select t.*,max(o.vn) as vn FROM opdscreen o
INNER JOIN
(select t.hn,s.smoking_type_id
FROM hos_smdr s
INNER JOIN
(select max(s.vstdate) as vstdate,pt.cid,pt.hn FROM  hos_smdr s
INNER JOIN patient pt  on pt.cid = s.cid
GROUP BY s.cid)t on t.cid = s.cid and t.vstdate = s.vstdate ORDER BY t.hn)t on t.hn = o.hn
WHERE o.vstdate BETWEEN '2019-10-01' AND '2020-09-30'
GROUP BY o.hn)t on t.vn = ov.vn

UNION

select ov.vstdate,ov.vsttime,t.*,(select doctorcode from opduser where loginname = ov.staff) as doctor 
,CASE 
                        WHEN smoking_type_id in('10') THEN '1B530'
                        WHEN smoking_type_id in('11') THEN '1B531'
                        WHEN smoking_type_id in('12','13') THEN '1B531'
                        WHEN smoking_type_id in('14') THEN '1B531'
                        WHEN smoking_type_id in('15','16') THEN '1B531'
                        end as smoking
FROM ovst ov
INNER JOIN
(select t.*,max(o.vn) as vn FROM opdscreen o
INNER JOIN
(select t.hn,s.smoking_type_id
FROM hos_smdr s
INNER JOIN
(select max(s.vstdate) as vstdate,pt.cid,pt.hn FROM  hos_smdr s
INNER JOIN patient pt  on pt.cid = s.cid
GROUP BY s.cid)t on t.cid = s.cid and t.vstdate = s.vstdate ORDER BY t.hn)t on t.hn = o.hn
WHERE o.vstdate BETWEEN '2019-10-01' AND '2020-09-30'
GROUP BY o.hn)t on t.vn = ov.vn)t1

UNION

select * FROM
(select ov.vstdate,ov.vsttime,t.*,(select doctorcode from opduser where loginname = ov.staff) as doctor 
,CASE 
                        WHEN drinking_type_id in('1','14') THEN '1B600'
                        WHEN drinking_type_id in('11','12','13') THEN '1B601'
                        WHEN drinking_type_id in('7') THEN '1B602'
                        WHEN drinking_type_id in('8') THEN '1B603'
                        WHEN drinking_type_id in('9','10') THEN '1B604'
                        end as drinking
FROM ovst ov
INNER JOIN
(select t.*,max(o.vn) as vn FROM opdscreen o
INNER JOIN
(select t.hn,s.drinking_type_id
FROM hos_smdr s
INNER JOIN
(select max(s.vstdate) as vstdate,pt.cid,pt.hn FROM  hos_smdr s
INNER JOIN patient pt  on pt.cid = s.cid
GROUP BY s.cid)t on t.cid = s.cid and t.vstdate = s.vstdate ORDER BY t.hn)t on t.hn = o.hn
WHERE o.vstdate BETWEEN '2019-10-01' AND '2020-09-30'
GROUP BY o.hn)t on t.vn = ov.vn

UNION

select ov.vstdate,ov.vsttime,t.*,(select doctorcode from opduser where loginname = ov.staff) as doctor 
,CASE 
                        
                        WHEN drinking_type_id in('7') THEN '1B610'
                        WHEN drinking_type_id in('8') THEN '1B611'
                        WHEN drinking_type_id in('9','10') THEN '1B611'
                        end as drinking
FROM ovst ov
INNER JOIN
(select t.*,max(o.vn) as vn FROM opdscreen o
INNER JOIN
(select t.hn,s.drinking_type_id
FROM hos_smdr s
INNER JOIN
(select max(s.vstdate) as vstdate,pt.cid,pt.hn FROM  hos_smdr s
INNER JOIN patient pt  on pt.cid = s.cid
GROUP BY s.cid)t on t.cid = s.cid and t.vstdate = s.vstdate ORDER BY t.hn)t on t.hn = o.hn
WHERE o.vstdate BETWEEN '2019-10-01' AND '2020-09-30'
GROUP BY o.hn)t on t.vn = ov.vn)t2) tall
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
            VALUE('$pp_special_id','$vn','$pp_special_type_id','$doctor','$pp_special_service_place_type_id','$entry_datetime','$dest_hospcode','$hn')";
            $this->exec_hosxp_pcu($sql);
        }
        
        $sql2 = "UPDATE serial 
SET serial_no = (select MAX(pp_special_id) FROM pp_special)
WHERE `name` = 'pp_special_id'";
            $this->exec_hosxp_pcu($sql2);
           Yii::$app->getSession()->setFlash('success', 'ปรับข้อมูลเรียบร้อย!! ');
        return $this->render('index');
    }

    public function actionPerson() {
        
        $session = Yii::$app->session;
        $token = $session->get('mytoken');
        $session->open();
        $url = Yii::$app->params['webservice'];

        $sql = "select (select hospitalcode from opdconfig) as HOSPCODE, p.CID, LPAD(p.person_id, 6, '0') as PID,
        house_id as HID,
        (select provis_code FROM pname WHERE name = p.pname ) as PRENAME
        , fname as NAME, lname as LNAME, patient_hn as HN, sex as SEX, birthdate as BIRTH, marrystatus as MSTATUS
        , occupation as OCCUPATION_OLD, (select nhso_code FROM occupation where occupation = p.occupation) as OCCUPATION_NEW
        , LPAD(p.citizenship, 3, '0') as RACE
        , LPAD(p.nationality, 3, '0') as NATION
        , religion as RELIGION, (select LPAD(provis_code, 2, '0') FROM education where education = p.education) as EDUCATION, p.person_house_position_id as FSTATUS
        , p.father_cid as FATHER, p.mother_cid as MOTHER, p.sps_cid as COUPLE, null as VSTATUS, null as MOVEIN
        , person_discharge_id as DISCHARGE, discharge_date as DDISCHARGE
        , null as ABOGROUP, null as RHGROUP, null as LABOR, null as PASSPORT
        , house_regist_type_id as TYPEAREA, last_update as D_UPDATE
        from person p where apicheck <> MD5(concat('wsc', last_update)) limit 1000 ";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
		
        foreach ($data as $data) {
            $HOSPCODE = $data['HOSPCODE'];
            $CID = $data['CID'];
            $PID = $data['PID'];
            $HID = $data['HID'];
            $PRENAME = $data['PRENAME'];
            $NAME = $data['NAME'];
            $LNAME = $data['LNAME'];
            $HN = $data['HN'];
            $SEX = $data['SEX'];
            $BIRTH = $data['BIRTH'];
            $MSTATUS = $data['MSTATUS'];
            $OCCUPATION_OLD = $data['OCCUPATION_OLD'];
            $OCCUPATION_NEW = $data['OCCUPATION_NEW'];
            $RACE = $data['RACE'];
            $NATION = $data['NATION'];
            $RELIGION = $data['RELIGION'];
            $EDUCATION = $data['EDUCATION'];
            $FSTATUS = $data['FSTATUS'];
            $FATHER = $data['FATHER'];
            $MOTHER = $data['MOTHER'];
            $COUPLE = $data['COUPLE'];
            $VSTATUS = $data['VSTATUS'];
            $MOVEIN = $data['MOVEIN'];
            $DISCHARGE = $data['DISCHARGE'];
            $DDISCHARGE = $data['DDISCHARGE'];
            $ABOGROUP = $data['ABOGROUP'];
            $RHGROUP = $data['RHGROUP'];
            $LABOR = $data['LABOR'];
            $PASSPORT = $data['PASSPORT'];
            $TYPEAREA = $data['TYPEAREA'];
            $D_UPDATE = $data['D_UPDATE'];

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
                    "Authorization: Bearer $token",
                    "Content-Type: application/json"
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);


            // echo $response;
        }

        $sql = "update person set apicheck = MD5(concat('wsc',last_update))";
        $this->exec_hosxp_pcu($sql);

       // Yii::$app->getSession()->setFlash('success', 'ส่งข้อมูลเรียบร้อยแล้ว!! ');
        return $this->redirect(['/f43file/default/epi']);
    }
    
    public function actionEpi() {
        
        $session = Yii::$app->session;
        $token = $session->get('mytoken');
        $session->open();
        $url = Yii::$app->params['webservice'];
        
         $sql1 = "CREATE TABLE IF NOT EXISTS f43check_epi (
  `SEQ` varchar(16) DEFAULT NULL,
  `DATE_SERV` date NOT NULL,
  `VACCINETYPE` varchar(3) NOT NULL,
  `apicheck` varchar(35) CHARACTER SET utf8 DEFAULT '',
  PRIMARY KEY (`HOSPCODE`,`PID`,`DATE_SERV`,`VACCINETYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620";
        $this->exec_hosxp_pcu($sql1);

        $sql = "select t.HOSPCODE,t.PID,os.seq_id as SEQ,t.service_date as DATE_SERV,t.export_vaccine_code as VACCINETYPE 
,t.HOSPCODE as VACCINEPLACE,t.PROVIDER,concat(t.service_date,' ',t.service_time) as D_UPDATE
FROM ovst_seq os
INNER JOIN
(select (select hospitalcode from opdconfig) as HOSPCODE
,LPAD(pw.person_id, 6, '0') as PID
,pws.service_date,pws.service_time,vn,t.export_vaccine_code,t.doctor_code as PROVIDER from person_wbc_service pws
LEFT JOIN person_wbc pw on pw.person_wbc_id = pws.person_wbc_id
INNER JOIN
(select w.person_wbc_service_id,wv.export_vaccine_code,w.doctor_code from person_wbc_vaccine_detail w
LEFT JOIN wbc_vaccine wv on wv.wbc_vaccine_id = w.wbc_vaccine_id
WHERE wv.export_vaccine_code is not NULL)t on t.person_wbc_service_id = pws.person_wbc_service_id)t on t.vn = os.vn
AND MD5(concat('wsc', os.seq_id,t.service_date,t.export_vaccine_code)) not in(select apicheck from f43check_epi)";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $HOSPCODE =$data['HOSPCODE'];
            $PID =$data['PID'];
            $SEQ =$data['SEQ'];
            $DATE_SERV =$data['DATE_SERV'];
            $VACCINETYPE =$data['VACCINETYPE'];
            $VACCINEPLACE =$data['VACCINEPLACE'];
            $PROVIDER =$data['PROVIDER'];
            $D_UPDATE =$data['D_UPDATE'];

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
                    "Authorization: Bearer $token",
                    "Content-Type: application/json"
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);


            // echo $response;
        }

        $sql = "INSERT IGNORE INTO f43check_epi(SEQ,DATE_SERV,VACCINETYPE,apicheck)
            (select os.seq_id as SEQ,t.service_date as DATE_SERV,t.export_vaccine_code as VACCINETYPE 
,MD5(concat('wsc', os.seq_id,t.service_date,t.export_vaccine_code)) as apicheck
FROM ovst_seq os
INNER JOIN
(select (select hospitalcode from opdconfig) as HOSPCODE
,LPAD(pw.person_id, 6, '0') as PID
,pws.service_date,pws.service_time,vn,t.export_vaccine_code,t.doctor_code as PROVIDER from person_wbc_service pws
LEFT JOIN person_wbc pw on pw.person_wbc_id = pws.person_wbc_id
INNER JOIN
(select w.person_wbc_service_id,wv.export_vaccine_code,w.doctor_code from person_wbc_vaccine_detail w
LEFT JOIN wbc_vaccine wv on wv.wbc_vaccine_id = w.wbc_vaccine_id
WHERE wv.export_vaccine_code is not NULL)t on t.person_wbc_service_id = pws.person_wbc_service_id)t on t.vn = os.vn
AND MD5(concat('wsc', os.seq_id,t.service_date,t.export_vaccine_code)) not in(select apicheck from f43check_epi))";
        $this->exec_hosxp_pcu($sql);

        Yii::$app->getSession()->setFlash('success', 'ส่งข้อมูลเรียบร้อยแล้ว!! ');
        return $this->render('index');
    }
    
    
    
    public function actionOpdallergy() {

        
           $sql = "select cid from patient WHERE (cid is not NULL and cid not LIKE'0%')";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $cid =$data['cid'];
       
            
             $last_check =  date('Y-m-d H:i:s');
         $sql = "REPLACE INTO wsc_check_patient(cid,last_check)
                    VALUE('$cid','$last_check')";
                        $this->exec_hosxp_pcu($sql);
                        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://127.0.0.1:3020/persons/opdallergy/$cid", //เปลี่ยนแปลง
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
             //   "Authorization: Bearer $token",
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
            $agent = $item['agent'];
            $note = $item['note'];
            
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://127.0.0.1:3013/f43exports/opdallergy",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{
                \"hn\":\"$hn\",
                \"agent\":\"$agent\",
                \"note\":\"$note\"
                    }",
                CURLOPT_HTTPHEADER => array(
                  //  "Authorization: Bearer $token2",
                    "Content-Type: application/json"
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

          
        }
        
       
        
        }  
        
        
    }
    

}
