<?php

namespace app\modules\pcureport\controllers;

use Yii;
use yii\web\Controller;
use app\modules\pcureport\models\HosBasedata;
use app\modules\pcureport\models\HosBasedataSub;
use app\config\components\AppController;
use app\modules\pcu\models\ReportLog;
use app\modules\pcu\models\Opdconfig;
use app\modules\pcu\models\Person;
use app\modules\pcu\models\PersonSearch;
use yii\data\ArrayDataProvider;

class HdcController extends AppController {

    public $enableCsrfValidation = false;

     protected function exec_hosxp_pcu($sql = NULL) {
        return \Yii::$app->db2->createCommand($sql)->execute();
    }
    public function actionIndex() {

        $basedata_id = '7';

        $sql = "select * from hos_basedata where id = '$basedata_id'";

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();

        foreach ($rawData as $data) {
            // $id = $data['id'];
            $base_data = $data['base_data'] . ' (' . $data['detail'] . ')';
        }

        $data = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('index', [
                    'data' => $data,
                    'basedata_id' => $basedata_id,
                    // 'id' => $id,
                    'base_data' => $base_data,
        ]);
    }

    public function actionHdcDtPerson() {



        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $sql = "select yearprocess from pk_byear WHERE id = '1'";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $yearprocess = $data['yearprocess'];
        }


        $id = '22';

        $sql = "select * FROM hos_basedata_sub WHERE id = '$id'";

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();

        foreach ($rawData as $data) {
            $tdate = $data['tdate'];
            $base_data = $data['basedata_sub_name'];
            $hdc_link = $data['hdc_link'];
        }
        $code = $opdconfig . 'basedata_sub:' . $data['id'];

        $log = new ReportLog();
        $log->code_data = $code;
        $log->user_id = \Yii::$app->user->identity->id;
        $log->datetime = date('Y-m-d H:i:s');
        // $log->data_index_id = $id;
        $log->ip = \Yii::$app->request->getUserIP();
        $log->save();

        $data = Yii::$app->request->post();

        // $date1 = isset($data['date1']) ? $data['date1'] : '';
        // $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "select t7.hospcode,t7.PID,t7.`NAME`,t7.LNAME,t7.birthdate
,t7.total_befor_birth,t7.age_y,t7.after_birth,t7.vaccine_date,
CASE 
WHEN t7.age_y = 20 THEN NULL
ELSE t7.vaccine_date2 END as vaccine_date2
,CASE 
WHEN t7.age_y = 20 THEN NULL
ELSE t7.vaccine_date3 END as vaccine_date3
FROM
(select t6.hospcode,t6.PID,t6.NAME,t6.LNAME,t6.birthdate,t6.total_befor_birth,t6.age_y
,t6.vaccine_date as vdate
,concat(DATE_FORMAT(t6.after_birth,'%d/%m/'),DATE_FORMAT(t6.after_birth,'%Y')+543) as after_birth
,concat(DATE_FORMAT(t6.vaccine_date,'%d/%m/'),DATE_FORMAT(t6.vaccine_date,'%Y')+543) as vaccine_date
,concat(DATE_FORMAT(t6.vaccine_date2,'%d/%m/'),DATE_FORMAT(t6.vaccine_date2,'%Y')+543) as vaccine_date2
,concat(DATE_FORMAT(t6.vaccine_date3,'%d/%m/'),DATE_FORMAT(t6.vaccine_date3,'%Y')+543) as vaccine_date3
from
(select t5.*
,CASE 
WHEN t5.total_befor_birth in(0) THEN DATE_SUB(t5.vaccine_date2, INTERVAL -6 MONTH)  
END as vaccine_date3
 FROM
(select t4.*
,CASE 
WHEN t4.total_befor_birth in(0) THEN DATE_SUB(t4.vaccine_date, INTERVAL -1 MONTH) 
WHEN t4.total_befor_birth in(1) THEN DATE_SUB(t4.vaccine_date, INTERVAL -6 MONTH) 
END as vaccine_date2
 FROM
(select t3.hospcode,t3.PID,t3.NAME,t3.LNAME,t3.age_y,concat(DATE_FORMAT(t3.BIRTH,'%d/%m/'),DATE_FORMAT(t3.BIRTH,'%Y')+543) as birthdate

,t3.after_birth
,if(t3.total_befor_birth = '',0,t3.total_befor_birth) as total_befor_birth
,t3.vaccine_date
FROM
(select t2.*,
CASE 
WHEN (t2.total_befor_birth = '' OR t2.age_y = 20) THEN t2.birth_now
WHEN t2.total_befor_birth = 1 THEN t2.birth_now
ELSE  t2.birth_now  END as vaccine_date
 FROM
(SELECT t.hospcode,t.PID,t.birth_now,t.NAME,t.LNAME,t.age_y,t.after_birth,t.check_time
,t.total_befor_birth,t.BIRTH

FROM
(select CONCAT(IF(DATE_FORMAT(BIRTH,'%m') IN(10,11,12),'$yearprocess'-1,'$yearprocess' ) 
,'-',DATE_FORMAT(BIRTH,'%m-%d')) as birth_now,t.* 
FROM hdc_dt_person t
WHERE t.hospcode = '$opdconfig' and check_status = 'ไม่ผ่าน')t)t2)t3)t4)t5)t6)t7
WHERE /*t7.age_y = '20' AND */t7.vdate <  date(NOW())

ORDER BY t7.age_y,t7.vdate ASC";
        $Rawdata = \Yii::$app->db->createCommand($sql)->queryAll();
        $data = new \yii\data\ArrayDataProvider([
            'allModels' => $Rawdata,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('hdc-dt-person', [
                    'data' => $data,
                    'base_data' => $base_data,
                    'tdate' => $tdate,
                    'hdc_link' => $hdc_link,
                        // 'date1' => $date1,
                        // 'date2' => $date2,
        ]);
    }

    public function actionHdcSpecialppChild() {



        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $sql = "select * from kpi_index_date WHERE id = '1'";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $b_date = $data['b_date'];
            $e_date = $data['e_date'];
            $file_name = $data['file_name'];
        }


        $id = '23';

        $sql = "select * FROM hos_basedata_sub WHERE id = '$id'";

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();

        foreach ($rawData as $data) {
            $tdate = $data['tdate'];
            $base_data = $data['basedata_sub_name'];
            $hdc_link = $data['hdc_link'];
        }
        $code = $opdconfig . 'basedata_sub:' . $data['id'];

        $log = new ReportLog();
        $log->code_data = $code;
        $log->user_id = \Yii::$app->user->identity->id;
        $log->datetime = date('Y-m-d H:i:s');
        // $log->data_index_id = $id;
        $log->ip = \Yii::$app->request->getUserIP();
        $log->save();

        $data = Yii::$app->request->post();


        $sql = "select concat(t_childdev_specialpp.NAME,' ',LNAME) as ptname,if(SEX = '1','ชาย','หญิง') as sex2,t_childdev_specialpp.* 
		,concat(ADDRESS,' หมู่ ' ,mid(t_childdev_specialpp.VHID,7,2),' ',th.full_name) as addr
		,concat(date_format(first_to_screen,'%d/%m/'),date_format(first_to_screen,'%Y')+543) as first_to_screen2
		,concat(date_format(end_to_screen,'%d/%m/'),date_format(end_to_screen,'%Y')+543) as end_to_screen2
		,concat(date_format(BIRTH,'%d/%m/'),date_format(BIRTH,'%Y')+543) as birthdate
		from t_childdev_specialpp
		LEFT JOIN thaiaddress th on th.addressid = mid(t_childdev_specialpp.VHID,1,6)
WHERE firstscreen = '' AND  DATE_FORMAT(NOW(),'%Y-%m') BETWEEN  DATE_FORMAT(first_to_screen,'%Y-%m')  AND DATE_FORMAT(end_to_screen,'%Y-%m') 
AND end_to_screen >= date(NOW()) AND HOSCODE = '$opdconfig'";
        $Rawdata = \Yii::$app->db->createCommand($sql)->queryAll();
        $data = new \yii\data\ArrayDataProvider([
            'allModels' => $Rawdata,
            'pagination' => false/* [
                  'pageSize' => 50,
                  ], */
        ]);

        return $this->render('hdc-specialpp-child', [
                    'data' => $data,
                    'base_data' => $base_data,
                    'tdate' => $tdate,
                    'hdc_link' => $hdc_link,
        ]);
    }

    public function actionFepi($user = null) {
        $url = Yii::$app->params['webservice'];
        if ($user == null) {
            $user = '#';
        }
        $sql = "select t2.* FROM
(select CASE WHEN count(person_id)< 1 THEN '-' 
ELSE concat(fname,' ',lname)
END as ptname,concat(DATE_FORMAT(birthdate,'%d/%m/'),DATE_FORMAT(birthdate,'%Y')+543) as birthdate
FROM
(select * from person 
where cid = '$user')t

UNION

select concat(fname,' ',lname) ptname,concat(DATE_FORMAT(birthdate,'%d/%m/'),DATE_FORMAT(birthdate,'%Y')+543) as birthdate 
from person 
where cid = '$user'
)t2
GROUP BY t2.ptname
LIMIT 1";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $ptname = $data['ptname'];
            $birthdate = $data['birthdate'];
        }

        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $id = '17'; //เลขจากตาราง hos_basedata_sub
        $sql = "select * FROM hos_basedata_sub WHERE id = '$id'";
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($rawData as $data) {
            $base_data = $data['basedata_sub_name'];
        }
        $code = $opdconfig . 'basedata_sub:' . $data['id'];
        $log = new ReportLog();
        $log->code_data = $code;
        $log->user_id = \Yii::$app->user->identity->id;
        $log->datetime = date('Y-m-d H:i:s');
        $log->ip = \Yii::$app->request->getUserIP();
        $log->save();

        $data = Yii::$app->request->post();
        if (!\Yii::$app->user->isGuest) {
            $user_id = \Yii::$app->user->identity->id;
            $sql = "select token_ from wsc_check_token where id = '$user_id'";
            $data = Yii::$app->db2->createCommand($sql)->queryAll();
            if (!$user_id) {
                throw new \Exception;
            }
            foreach ($data as $data) {
                $token_ = $data['token_'];
            }
            try {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$url/epis/$user", //เปลี่ยนแปลง
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

                $dataProvider = new ArrayDataProvider([
                    'allModels' => $data,
                    'pagination' => false, /* [
                      'pageSize' => 3,
                      ] , */
                    'sort' => [
                        'attributes' => ['id'],
                    ],
                ]);
            } catch (\Exception $e) {

                //echo "ท่านไม่ได้รับสิทธ";
                return $this->redirect(['/site/api-err']);
            }
        }

        return $this->render('fepi', [
                    'user' => $user,
                    'ptname' => $ptname,
                    'birthdate' => $birthdate,
                    'dataProvider' => $dataProvider,
        ]);
    }
            public function actionClinicmember() {
        
        $url = Yii::$app->params['webservice'];

        $basedata_id = '2';

        $sql = "select * from hos_basedata where id = '$basedata_id'";

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();

        foreach ($rawData as $data) {
            // $id = $data['id'];
            $base_data = $data['base_data'] . ' (' . $data['detail'] . ')';
        }

        if (!\Yii::$app->user->isGuest) {
            $user_id = \Yii::$app->user->identity->id;

            $sql = "select token_ from wsc_check_token where id = '$user_id'";
            $data = Yii::$app->db2->createCommand($sql)->queryAll();
            if (!$user_id) {
                throw new \Exception;
            }
            foreach ($data as $data) {
                $token_ = $data['token_'];
                $date_update = date('Y-m-d H:i:s');
                //date_update wsc_check_token
                 $sql = "UPDATE wsc_check_token  SET date_update = '$date_update' where id = '$user_id'";
                        $this->exec_hosxp_pcu($sql);
            }


            try {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$url/ancs", //เปลี่ยนแปลง
                    CURLOPT_RETURNTRANSFER => true,
                    //  CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    //    CURLOPT_POSTFIELDS => "",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer $token_",
                        "Content-Type: application/json"
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                $data = json_decode($response, true);


                foreach ($data['data'] as $value) {
                    $cid = $value['cid'];
                    $clinic = $value['clinic'];
                    
                    $sql = "select cid from person where cid in('$cid')";


                    $data = \Yii::$app->db2->createCommand($sql)->queryAll();


                    foreach ($data as $data) {
                        $cid2 = $data['cid'];
                        
                        
                        $sql = "REPLACE INTO wsc_clinicmember_cid(cid,clinic)
                    VALUE('$cid2','$clinic')";
                        $this->exec_hosxp_pcu($sql);
                    }
                }


                $sql = "select ac.cid,concat(p.pname,p.fname,' ',p.lname) as ptname
                    ,TIMESTAMPDIFF(YEAR,birthdate,date(now()))
                    from person p
                    inner join anc_cid ac on ac.cid = p.cid order by ac.rxdate desc";


                $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
                $anc = new \yii\data\ArrayDataProvider([
                    'allModels' => $rawData,
                    'pagination' => [
                        'pageSize' => 50,
                    ],
                ]);
            } catch (\Exception $e) {

                //echo "ท่านไม่ได้รับสิทธ";
                return $this->redirect(['/site/api-err']);
            }
        }
        // print_r([$cid]);

        return $this->render('clinicmember', [
                    'anc' => $anc,
                    'basedata_id' => $basedata_id,
                    // 'id' => $id,
                    'base_data' => $base_data,
        ]);
    }

}
