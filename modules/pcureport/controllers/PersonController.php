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

class PersonController extends AppController {

    public $enableCsrfValidation = false;

    public function actionIndex() {

        $basedata_id = '1';

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

    public function actionPiramid() {

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

        return $this->render('piramid', [
                    'person' => $person,
                        //  'date1' => $date1,
                        //  'date2' => $date2,
        ]);
    }

    public function actionPersonDtVaccine() {



        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $sql = "select * from kpi_index_date WHERE id = '1'"; //hosbase_data_id
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $b_date = $data['b_date'];
            $e_date = $data['e_date'];
            $file_name = $data['file_name'];
        }


        $id = '4'; // basedata_sub_id

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

        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "select pt.hn,concat(pt.pname,pt.fname,' ',pt.lname) as ptname
,concat(DATE_FORMAT(vn.vstdate,'%d/%m/'),DATE_FORMAT(vn.vstdate,'%Y')+543) as vstdate,
concat(DATE_FORMAT(pt.birthday,'%d/%m/'),DATE_FORMAT(pt.birthday,'%Y')+543) as birthday,
vn.age_y
FROM ovst_vaccine  ov
INNER JOIN vn_stat vn on vn.vn = ov.vn
LEFT JOIN patient pt on pt.hn = vn.hn
WHERE ov.person_vaccine_id in(select person_vaccine_id FROM person_vaccine WHERE export_vaccine_code = '106')
AND vn.vstdate BETWEEN '$date1' AND '$date2'";
        $Rawdata = \Yii::$app->db2->createCommand($sql)->queryAll();
        $data = new \yii\data\ArrayDataProvider([
            'allModels' => $Rawdata,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);


        return $this->render('person-dt-vaccine', [
                    'data' => $data,
                    'base_data' => $base_data,
                    'date1' => $date1,
                    'date2' => $date2,
        ]);
    }

    public function actionPersonDtVaccine2() {



        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $sql = "select yearprocess from pk_byear WHERE id = '1'";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $yearprocess = $data['yearprocess'];
        }


        $id = '18';

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

        return $this->render('person-dt-vaccine2', [
                    'data' => $data,
                    'base_data' => $base_data,
                        // 'date1' => $date1,
                        // 'date2' => $date2,
        ]);
    }

    public function actionType1() {

        $sql = "select person_id,pname,fname,lname,concat(DATE_FORMAT(birthdate,'%d-%m-'),DATE_FORMAT(birthdate,'%Y')+543) as birthdate 
,concat(DATE_FORMAT(last_update,'%d-%m-'),DATE_FORMAT(last_update,'%Y')+543) as last_update
from person p WHERE p.house_regist_type_id = '1' AND person_discharge_id not in('1')
ORDER BY date(last_update) asc";


        $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        $person = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
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

        $id = '6';

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

        return $this->render('type1', [
                    'person' => $person,
                        //  'date1' => $date1,
                        //  'date2' => $date2,
        ]);
    }

    public function actionType2() {

        $sql = "select person_id,pname,fname,lname,concat(DATE_FORMAT(birthdate,'%d-%m-'),DATE_FORMAT(birthdate,'%Y')+543) as birthdate 
,concat(DATE_FORMAT(last_update,'%d-%m-'),DATE_FORMAT(last_update,'%Y')+543) as last_update
from person p WHERE p.house_regist_type_id = '2' AND person_discharge_id not in('1')
ORDER BY last_update desc";


        $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        $person = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

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


        $id = '7';

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


        return $this->render('type2', [
                    'person' => $person,
                        //  'date1' => $date1,
                        //  'date2' => $date2,
        ]);
    }

    public function actionType3() {

        $sql = "select person_id,pname,fname,lname,concat(DATE_FORMAT(birthdate,'%d-%m-'),DATE_FORMAT(birthdate,'%Y')+543) as birthdate 
,concat(DATE_FORMAT(last_update,'%d-%m-'),DATE_FORMAT(last_update,'%Y')+543) as last_update
from person p WHERE p.house_regist_type_id = '3' AND person_discharge_id not in('1')
ORDER BY last_update desc";


        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }


        $person = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $sql = "select * from kpi_index_date WHERE id = '1'";


        try {
            $data = Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        foreach ($data as $data) {
            $b_date = $data['b_date'];
            $e_date = $data['e_date'];
            $file_name = $data['file_name'];
        }


        $id = '8';

        $sql = "select * FROM hos_basedata_sub WHERE id = '$id'";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }


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


        return $this->render('type3', [
                    'person' => $person,
                        //  'model' => $model,
                        //  'date1' => $date1,
                        //  'date2' => $date2,
        ]);
    }

    public function actionType4() {

        $sql = "select person_id,pname,fname,lname,concat(DATE_FORMAT(birthdate,'%d-%m-'),DATE_FORMAT(birthdate,'%Y')+543) as birthdate 
,concat(DATE_FORMAT(last_update,'%d-%m-'),DATE_FORMAT(last_update,'%Y')+543) as last_update
from person p WHERE p.house_regist_type_id = '4' AND person_discharge_id not in('1')
ORDER BY last_update desc";
        try {
            $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $person = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $sql = "select * from kpi_index_date WHERE id = '1'";

        try {
            $data = Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        foreach ($data as $data) {
            $b_date = $data['b_date'];
            $e_date = $data['e_date'];
            $file_name = $data['file_name'];
        }


        $id = '9';

        $sql = "select * FROM hos_basedata_sub WHERE id = '$id'";

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }



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


        return $this->render('type4', [
                    'person' => $person,
                        //  'date1' => $date1,
                        //  'date2' => $date2,
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->person_id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    public function actionTestload() {
        return $this->render('testload');
    }

    public function actionVom() {
        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $sql = "select * from kpi_index_date WHERE id = '1'"; //hosbase_data_id
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $b_date = $data['b_date'];
            $e_date = $data['e_date'];
            $file_name = $data['file_name'];
        }


        $id = '27'; // basedata_sub_id

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

        //  $date1 = isset($data['date1']) ? $data['date1'] : '';
        // $date2 = isset($data['date2']) ? $data['date2'] : '';

        $sql = "select t.*,p.cid,concat(p.pname,p.fname,' ',p.lname) as ptname,TIMESTAMPDIFF(YEAR,birthdate,NOW()) as age_y,ptt.`name` as pttname
            ,if(p.person_house_position_id='1','เจ้าบ้าน','ผู้อาศัย') as person_position
            FROM person p
INNER JOIN
(select h.address,h.house_id,v.village_moo,v.village_name,(select concat(p.pname,fname,' ',lname) FROM person p where p.person_id = vom.person_id ) as hpname
from village_organization_member_service vo
LEFT JOIN house h on h.house_id = vo.house_id
LEFT JOIN village v on v.village_id = vo.village_id
LEFT JOIN village_organization_member vom on vom.village_organization_mid = vo.village_organization_mid
WHERE vom.person_id is not NULL)t on t.house_id = p.house_id
LEFT JOIN pttype ptt on ptt.pttype = p.pttype
WHERE p.person_discharge_id not in('1')
ORDER BY t.hpname,village_moo,address ASC";
        try {
            $Rawdata = \Yii::$app->db2->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $data = new \yii\data\ArrayDataProvider([
            'allModels' => $Rawdata,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);


        return $this->render('vom', [
                    'data' => $data,
                    'base_data' => $base_data,
                        //  'date1' => $date1,
                        //  'date2' => $date2,
        ]);
    }

}
