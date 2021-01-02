<?php

namespace app\modules\pcureport\controllers;

use app\config\components\AppController;
use app\modules\pcu\models\Opdconfig;
use app\modules\pcu\models\ReportLog;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `pcureport` module
 */
class WbcController extends AppController
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

        $basedata_id = '3';

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

    public function actionPiramid()
    {

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
            'pagination' => false,
        ]);

        return $this->render('piramid', [
            'person' => $person,
            //  'date1' => $date1,
            //  'date2' => $date2,

        ]);
    }

    public function actionRota1()
    {

        $opd = Opdconfig::find()
            ->one();
        $opdconfig = $opd->hospitalcode;

        $sql = "select * from kpi_index_date WHERE id = '3'";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $b_date = $data['b_date'];
            $e_date = $data['e_date'];
            $file_name = $data['file_name'];
        }

        $id = '10';

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

        //   $date1 = isset($data['date1']) ? $data['date1'] : '';
        //   $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "SELECT t.*,concat(DATE_FORMAT(mindate,'%d-%m-'),DATE_FORMAT(mindate,'%Y')+543) as mindate2
,concat(DATE_FORMAT(maxdate,'%d-%m-'),DATE_FORMAT(maxdate,'%Y')+543) as maxdate2
FROM
(select person_id,concat(pname,fname,' ',lname) as ptname,concat(DATE_FORMAT(birthdate,'%d-%m-'),DATE_FORMAT(birthdate,'%Y')+543) as birthday
,TIMESTAMPDIFF(WEEK,birthdate,NOW()) as age_y
,DATE_SUB(birthdate, INTERVAL -6 WEEK) as mindate
,DATE_SUB(birthdate, INTERVAL -15 WEEK) as maxdate
from person
WHERE TIMESTAMPDIFF(WEEK,birthdate,NOW()) BETWEEN 6  AND 15)t

WHERE t.person_id not in(select p.person_id

from ovstdiag ov
LEFT JOIN patient pt on pt.hn = ov.hn
LEFT JOIN person p on p.patient_hn = pt.hn
INNER JOIN person_wbc_service pw on pw.vn = ov.vn
INNER JOIN (select pw.person_wbc_service_id from person_wbc_vaccine_detail pw
LEFT JOIN wbc_vaccine w on w.wbc_vaccine_id = pw.wbc_vaccine_id
WHERE export_vaccine_code in('R11'))t on t.person_wbc_service_id = pw.person_wbc_service_id
WHERE icd10 = 'Z258' ) AND
date(NOW()) BETWEEN t.mindate AND t.maxdate
";
        $Rawdata = \Yii::$app->db2->createCommand($sql)->queryAll();
        $data = new \yii\data\ArrayDataProvider([
            'allModels' => $Rawdata,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('rota1', [
            'data' => $data,
            'base_data' => $base_data,
            //   'date1' => $date1,
            //  'date2' => $date2,
        ]);
    }

    public function actionRota1Compleat()
    {

        $opd = Opdconfig::find()
            ->one();
        $opdconfig = $opd->hospitalcode;

        $sql = "select * from kpi_index_date WHERE id = '3'";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $b_date = $data['b_date'];
            $e_date = $data['e_date'];
            $file_name = $data['file_name'];
        }

        $id = '15';

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

        $sql = "select ov.vn,ov.hn,p.person_id,ov.vstdate,concat(date_format(p.birthdate,'%d/%m/'),date_format(p.birthdate,'%Y')+543) as birthdate
		,concat(date_format(pw.service_date,'%d/%m/'),date_format(pw.service_date,'%Y')+543) as service_date
,concat(p.pname,p.fname,' ',p.lname) as ptname
,TIMESTAMPDIFF(WEEK,birthdate,pw.service_date)+1 as vaccine_week
,CASE
 when pw.service_date BETWEEN DATE_SUB(p.birthdate, INTERVAL -6 WEEK) AND DATE_SUB(p.birthdate, INTERVAL -15 WEEK) THEN '/'
ELSE 'X' END as cc

from ovstdiag ov
LEFT JOIN patient pt on pt.hn = ov.hn
LEFT JOIN person p on p.patient_hn = pt.hn
INNER JOIN person_wbc_service pw on pw.vn = ov.vn
INNER JOIN (select pw.person_wbc_service_id from person_wbc_vaccine_detail pw
LEFT JOIN wbc_vaccine w on w.wbc_vaccine_id = pw.wbc_vaccine_id
WHERE export_vaccine_code in('R11'))t on t.person_wbc_service_id = pw.person_wbc_service_id
WHERE icd10 = 'Z258'
";
        $Rawdata = \Yii::$app->db2->createCommand($sql)->queryAll();
        $data = new \yii\data\ArrayDataProvider([
            'allModels' => $Rawdata,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('rota1-compleat', [
            'data' => $data,
            'base_data' => $base_data,
            // 'date1' => $date1,
            // 'date2' => $date2,
        ]);
    }

    public function actionRota2()
    {

        $opd = Opdconfig::find()
            ->one();
        $opdconfig = $opd->hospitalcode;

        $sql = "select * from kpi_index_date WHERE id = '3'";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $b_date = $data['b_date'];
            $e_date = $data['e_date'];
            $file_name = $data['file_name'];
        }

        $id = '16';

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

        //   $date1 = isset($data['date1']) ? $data['date1'] : '';
        //   $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "select t2.*
,concat(DATE_FORMAT(mindate,'%d-%m-'),DATE_FORMAT(mindate,'%Y')+543) as mindate2
,concat(DATE_FORMAT(maxdate,'%d-%m-'),DATE_FORMAT(maxdate,'%Y')+543) as maxdate2
,TIMESTAMPDIFF(WEEK,birthdate,NOW()) as age_y
 FROM
(select t.*,DATE_SUB(t.service_date, INTERVAL -4 WEEK) as mindate
,DATE_SUB(t.birthdate, INTERVAL -24 WEEK) as maxdate
FROM
(select ov.vn,ov.hn,p.person_id,ov.vstdate,p.birthdate,pw.service_date,concat(date_format(p.birthdate,'%d/%m/'),date_format(p.birthdate,'%Y')+543) as birthday
,concat(date_format(pw.service_date,'%d/%m/'),date_format(pw.service_date,'%Y')+543) as service_date2
,concat(p.pname,p.fname,' ',p.lname) as ptname
,TIMESTAMPDIFF(WEEK,birthdate,pw.service_date)+1 as vaccine_week
,CASE
 when pw.service_date BETWEEN DATE_SUB(p.birthdate, INTERVAL -6 WEEK) AND DATE_SUB(p.birthdate, INTERVAL -15 WEEK) THEN '/'
ELSE 'X' END as cc

from ovstdiag ov
LEFT JOIN patient pt on pt.hn = ov.hn
LEFT JOIN person p on p.patient_hn = pt.hn
INNER JOIN person_wbc_service pw on pw.vn = ov.vn
INNER JOIN (select pw.person_wbc_service_id from person_wbc_vaccine_detail pw
LEFT JOIN wbc_vaccine w on w.wbc_vaccine_id = pw.wbc_vaccine_id
WHERE export_vaccine_code in('R11'))t on t.person_wbc_service_id = pw.person_wbc_service_id
WHERE icd10 = 'Z258' )t
WHERE t.cc = '/')t2
";
        $Rawdata = \Yii::$app->db2->createCommand($sql)->queryAll();
        $data = new \yii\data\ArrayDataProvider([
            'allModels' => $Rawdata,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('rota2', [
            'data' => $data,
            'base_data' => $base_data,
            //   'date1' => $date1,
            //  'date2' => $date2,
        ]);
    }

    public function actionRota2Compleat()
    {

        $opd = Opdconfig::find()
            ->one();
        $opdconfig = $opd->hospitalcode;

        $sql = "select * from kpi_index_date WHERE id = '3'";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $b_date = $data['b_date'];
            $e_date = $data['e_date'];
            $file_name = $data['file_name'];
        }

        $id = '25';

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

        $sql = "select ov.vn,ov.hn,p.person_id,ov.vstdate,concat(date_format(p.birthdate,'%d/%m/'),date_format(p.birthdate,'%Y')+543) as birthdate
		,concat(date_format(pw.service_date,'%d/%m/'),date_format(pw.service_date,'%Y')+543) as service_date
,concat(p.pname,p.fname,' ',p.lname) as ptname
,TIMESTAMPDIFF(WEEK,birthdate,pw.service_date)+1 as vaccine_week
,CASE
 when pw.service_date BETWEEN DATE_SUB(p.birthdate, INTERVAL -6 WEEK) AND DATE_SUB(p.birthdate, INTERVAL -15 WEEK) THEN '/'
ELSE 'X' END as cc

from ovstdiag ov
LEFT JOIN patient pt on pt.hn = ov.hn
LEFT JOIN person p on p.patient_hn = pt.hn
INNER JOIN person_wbc_service pw on pw.vn = ov.vn
INNER JOIN (select pw.person_wbc_service_id from person_wbc_vaccine_detail pw
LEFT JOIN wbc_vaccine w on w.wbc_vaccine_id = pw.wbc_vaccine_id
WHERE export_vaccine_code in('R11'))t on t.person_wbc_service_id = pw.person_wbc_service_id
WHERE icd10 = 'Z258'
";
        $Rawdata = \Yii::$app->db2->createCommand($sql)->queryAll();
        $data = new \yii\data\ArrayDataProvider([
            'allModels' => $Rawdata,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('rota2-compleat', [
            'data' => $data,
            'base_data' => $base_data,
            // 'date1' => $date1,
            // 'date2' => $date2,
        ]);
    }

    public function actionWbcperson()
    {

        $opd = Opdconfig::find()
            ->one();
        $opdconfig = $opd->hospitalcode;

        $id = '29'; //เลขจากตาราง hos_basedata_sub
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

                $url = Yii::$app->params['pcuservice'];
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$url/epis", //เปลี่ยนแปลง
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer $token_",
                        "Content-Type: application/json",
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                $data = json_decode($response, true);

                $dataProvider = new ArrayDataProvider([
                    'allModels' => $data,
                    'pagination' => [
                        'pageSize' => 10,
                    ],
                    'sort' => [
                        'attributes' => ['id'],
                    ],
                ]);

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$url/epis/wbcvaccine", //เปลี่ยนแปลง
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer $token_",
                        "Content-Type: application/json",
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                $data = json_decode($response, true);

                $dataProvider2 = new ArrayDataProvider([
                    'allModels' => $data,
                    'pagination' => [
                        'pageSize' => 50,
                    ],
                    'sort' => [
                        'attributes' => ['id'],
                    ],
                ]);
            } catch (\Exception $e) {

                //echo "ท่านไม่ได้รับสิทธ";
                return $this->redirect(['/site/api-err']);
            }
        }

        return $this->render('wbcperson', [
            //'t' => $t,
            // 'basedata_id' => $basedata_id,
            // 'id' => $id,
            'base_data' => $base_data,
            'dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,

        ]);
    }

}
