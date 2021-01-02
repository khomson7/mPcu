<?php

namespace app\modules\pcureport\controllers;

use Yii;
use yii\web\Controller;
use app\modules\pcureport\models\HosBasedata;
use app\modules\pcureport\models\HosBasedataSub;
use app\config\components\AppController;
use app\modules\pcu\models\ReportLog;
use app\modules\pcu\models\Opdconfig;
use yii\data\ArrayDataProvider;

/**
 * Default controller for the `pcureport` module
 */
class AncController extends AppController {

    protected function exec_pcu_master($sql = NULL) {
        return \Yii::$app->db->createCommand($sql)->execute();
    }

    protected function exec_hosxp_pcu($sql = NULL) {
        return \Yii::$app->db2->createCommand($sql)->execute();
    }

    public function actionIndex() {

        $basedata_id = '2';

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

    public function actionHmainanc() {

        $sql = "select 
COUNT( CASE WHEN  house_regist_type_id ='1' THEN person_id END)  type1
,COUNT( CASE WHEN  house_regist_type_id ='2' THEN person_id END)  type2
,COUNT( CASE WHEN  house_regist_type_id ='3' THEN person_id END)  type3
,COUNT( CASE WHEN  house_regist_type_id ='4' THEN person_id END)  type4
from person
WHERE death not in('Y')";


        $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        $person = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('hmainanc', [
                    'person' => $person,
                        //  'date1' => $date1,
                        //  'date2' => $date2,
        ]);
    }
/*
    public function actionAnc1() {

        $data_api0 = file_get_contents('http://127.0.0.1:3012/api/peranc');
        $json_api0 = json_decode($data_api0, true);

        $data = [];
        foreach ($json_api0['data'] as $key => $value) {
            //Make a multidimensional array
            $data = ['date' => date($value['birthday']),
                'person_anc_id' => date($value['person_anc_id'])];
        }
        // echo \yii\helpers\Json::encode($data);

        return $this->render('anc1', [
                    'data' => $data,
        ]);
    }
*/
    
    public function actionAncapi() {
        
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

              

                //  $data_api0 = file_get_contents('http://127.0.0.1:3020/ancs');
                //  $json_api0 = json_decode($data_api0, true);

                foreach ($data['data'] as $value) {
                   $cid = $value['cid'];
                    $rxdate = $value['rxdate'];

                   echo $rxdate;
                    
                   $sql = "select cid from person where cid in('$cid')";


                   $data = \Yii::$app->db2->createCommand($sql)->queryAll();


                   foreach ($data as $data) {
                   $cid2 = $data['cid'];
                        
                        
                     $sql = "REPLACE INTO anc_cid(cid,rxdate)
                    VALUE('$cid2','$rxdate')";
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

        return $this->render('ancapi', [
                    'anc' => $anc,
                    'basedata_id' => $basedata_id,
                    // 'id' => $id,
                    'base_data' => $base_data,
        ]);
    }

    public function actionFromhos() {



        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $sql1 = "select subdistcode from chospital_amp where hoscode ='$opdconfig' ";
        $data = Yii::$app->db->createCommand($sql1)->queryAll();
        foreach ($data as $data) {
            $subdistcode = $data['subdistcode'];
        }

        $sql = "select * from kpi_index_date WHERE id = '3'";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $b_date = $data['b_date'];
            $e_date = $data['e_date'];
            $file_name = $data['file_name'];
        }


        $id = '17';

        $sql = "select * FROM hos_basedata_sub WHERE id = '$id'";

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();

        foreach ($rawData as $data) {
            // $id = $data['id'];
            $base_data = $data['basedata_sub_name'];
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
        //  $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "select * from
(select concat(p.pname,p.fname,' ',p.lname) as ptname
,p.addrpart,p.moopart
,th.full_name 
,concat(DATE_FORMAT(p.birthday,'%d/%m/'),DATE_FORMAT(p.birthday,'%Y')+543) as birthdate
,concat(DATE_FORMAT(p.lmp,'%d/%m/'),DATE_FORMAT(p.lmp,'%Y')+543) as lmp
,concat(DATE_FORMAT(p.edc,'%d/%m/'),DATE_FORMAT(p.edc,'%Y')+543) as edc

from prasat_anc_person p
INNER JOIN chospital_amp c on p.tmbpart = c.subdistcode
LEFT JOIN thaiaddress th on th.chwpart = p.chwpart and th.amppart = p.amppart and th.tmbpart = p.tmbpart
WHERE c.subdistcode = '$subdistcode' AND p.anc_register_date BETWEEN DATE_SUB(NOW(), INTERVAL 12 month) AND NOW()
GROUP BY person_anc_id
ORDER BY p.moopart,p.anc_register_date DESC
)t
";
        $Rawdata = \Yii::$app->db->createCommand($sql)->queryAll();
        $data = new \yii\data\ArrayDataProvider([
            'allModels' => $Rawdata,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('fromhos', [
                    'data' => $data,
                    'base_data' => $base_data,
                        // 'date1' => $date1,
                        // 'date2' => $date2,
        ]);
    }

    
    

    public function actionDepress() {
        return $this->render('depress');
    }

    public function actionFanc($user = null) {

        $url = Yii::$app->params['webservice'];

        if ($user == null) {
            $user = '#'; //หากยังไม่ได้ post ค่า
        }
        //เรียกข้อมูลไปแสดงที่ grid
        $sql = "select t2.* FROM
(select CASE WHEN count(person_id)< 1 THEN '-' 
ELSE concat(fname,' ',lname)
END as ptname,concat(DATE_FORMAT(birthdate,'%d/%m/'),DATE_FORMAT(birthdate,'%Y')+543) as birthdate
,TIMESTAMPDIFF(YEAR,birthdate,date(NOW())) as age_y,h.address,v.village_name
FROM
(select * from person 
where cid = '$user')t
LEFT JOIN village v on v.village_id = t.village_id
LEFT JOIN house h on h.house_id = t.house_id

UNION

select concat(fname,' ',lname) ptname,concat(DATE_FORMAT(birthdate,'%d/%m/'),DATE_FORMAT(birthdate,'%Y')+543) as birthdate 
,TIMESTAMPDIFF(YEAR,birthdate,date(NOW())) as age_y,h.address,v.village_name
from person p
LEFT JOIN village v on v.village_id = p.village_id
LEFT JOIN house h on h.house_id = p.house_id
where cid = '$user'
)t2
GROUP BY t2.ptname
LIMIT 1";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $ptname = $data['ptname'];
            $birthdate = $data['birthdate'];
            $age_y = $data['age_y'];
            $address = $data['address'];
            $village_name = $data['village_name'];
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
                    CURLOPT_URL => "$url/ancs/$user", //เปลี่ยนแปลง
                    CURLOPT_RETURNTRANSFER => true,       
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
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

        return $this->render('fanc', [
                    'user' => $user,
                    'ptname' => $ptname,
                    'birthdate' => $birthdate,
                    'age_y' => $age_y,
                    'address' => $address,
                    'village_name' => $village_name,
                    'dataProvider' => $dataProvider,
        ]);
    }

}
