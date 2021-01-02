<?php

namespace app\modules\pcu\controllers;

use Yii;
use yii\base\Model;
use app\modules\pcu\models\Mdrugitems;
use app\modules\pcu\models\MdrugitemsSearch2;
use app\modules\pcu\models\MdrugitemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\pcu\models\MsDrugitems;
use app\config\components\AppController;
use app\modules\pcu\models\ReportLog;
use app\modules\pcu\models\Drugitems;
use app\modules\pcu\models\CountDataPcu;
use app\modules\pcu\models\SystemBackupLog;
use app\modules\pcu\models\Opdconfig;
use app\modules\pcu\models\CheckBackupLog;
use app\modules\pcu\models\PersonTargetDetail;
use yii\db\Query;

class MycountController extends AppController {

    protected function exec_pcu_master($sql = NULL) {
        return \Yii::$app->db->createCommand($sql)->execute();
    }

    protected function exec_hosxp_pcu($sql = NULL) {
        return \Yii::$app->db2->createCommand($sql)->execute();
    }

    public function actionMdrugupdate() {

        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $istatus = 'Y';
        $drugcount = Drugitems::find()
                ->where('istatus = :istatus', [':istatus' => $istatus])
                ->count();

        $check_status = '1';
        $model = Drugitems::find()->select('icode')/* ->asArray() */
                ->all();
        $query = Mdrugitems::find()
                ->where(['NOT IN', 'icode', $model])
                ->andWhere('check_status = :check_status', [':check_status' => $check_status])
                ->count();

        $data_id = '1'; //หมายเลข dashboard
        $log = new CountDataPcu();
        $log->count_data = $query;
        $log->data_id = $data_id;
        $log->datetime = date('Y-m-d H:i:s');
        $log->hosp_code = $opdconfig;
        $log->remark = $drugcount;
        $log->ip = \Yii::$app->request->getUserIP();
        if ($log->save())
            ;
    }

    public function actionSystemBackupLog() {
        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $b_year = '2563';

        $thread = SystemBackupLog::find()
                        // ->where('_check = :_check', [':_check' => $count])
                        ->orderBy(['backup_log_id' => SORT_DESC])->one();


        //  $sql = "delete from check_backup_log where hosp_code = '$opdconfig'";
        //  $this->exec_pcu_master($sql);

        $idkey = $opdconfig . $thread->backup_log_id;
        $log = new CheckBackupLog();
        $log->idkey = $idkey;
        $log->count_data = $thread->backup_size;
        // $log->data_id = $id;
        $log->datetime = $thread->backup_datetime;
        $log->datetime_send = date('Y-m-d H:i:s');
        $log->hosp_code = $opdconfig;
        $log->ip = \Yii::$app->request->getUserIP();
        $log->save();


        $sql = "INSERT INTO vaccine_combination
select (@cnt := @cnt + 1) as vaccine_combination_id,`name` as vaccine_code,`name` as vaccine_combine_code,NULL
from provis_vcctype
CROSS JOIN (SELECT @cnt := (select MAX(vaccine_combination_id) FROM vaccine_combination)) AS dummy
WHERE `code` in('R11','R12')
AND `name` not in(select vaccine_code FROM vaccine_combination)";
        $this->exec_hosxp_pcu($sql);

        $sql2 = "UPDATE  person_vaccine  pv
INNER JOIN (select `name`,CASE 
WHEN `code` = 'R11' THEN 'โรต้า (Rotarix) ครั้งที่1'
WHEN `code` = 'R12' THEN 'โรต้า (Rotarix) ครั้งที่2'
WHEN `code` = 'R21' THEN 'โรต้า (RotaTeq) ครั้งที่1'
WHEN `code` = 'R22' THEN 'โรต้า (RotaTeq) ครั้งที่2'
WHEN `code` = 'R23' THEN 'โรต้า (RotaTeq) ครั้งที่3'
END as vaccine_name
FROM provis_vcctype
WHERE `code` in('R11','R12','R21','R22','R23'))t on t.`name` = pv.vaccine_code
SET pv.vaccine_name = t.vaccine_name";
        $this->exec_hosxp_pcu($sql2);

        $sql3 = "UPDATE  wbc_vaccine  pv
INNER JOIN (select `name`,CASE 
WHEN `code` = 'R11' THEN 'โรต้า (Rotarix) ครั้งที่1'
WHEN `code` = 'R12' THEN 'โรต้า (Rotarix) ครั้งที่2'
WHEN `code` = 'R21' THEN 'โรต้า (RotaTeq) ครั้งที่1'
WHEN `code` = 'R22' THEN 'โรต้า (RotaTeq) ครั้งที่2'
WHEN `code` = 'R23' THEN 'โรต้า (RotaTeq) ครั้งที่3'
END as vaccine_name
FROM provis_vcctype
WHERE `code` in('R11','R12','R21','R22','R23'))t on t.`name` = pv.wbc_vaccine_code
SET pv.wbc_vaccine_name = t.vaccine_name";
        $this->exec_hosxp_pcu($sql3);


        $last_update = '2019-06-31';

        // $connection = Yii::$app->db2;
        $sex1 = \app\modules\pcu\models\Person::find()
                ->where('sex= :sex', [':sex' => '1'])
                ->andWhere(['NOT IN', 'person_discharge_id', '1'])
                ->count();

        $sex2 = \app\modules\pcu\models\Person::find()
                ->where('sex= :sex', [':sex' => '2'])
                ->andWhere(['NOT IN', 'person_discharge_id', '1'])
                ->count();

        $type1 = \app\modules\pcu\models\Person::find()
                ->where('house_regist_type_id= :house_regist_type_id', [':house_regist_type_id' => '1'])
                ->andWhere(['NOT IN', 'person_discharge_id', '1'])
                ->count();

        $type2 = \app\modules\pcu\models\Person::find()
                ->where('house_regist_type_id= :house_regist_type_id', [':house_regist_type_id' => '2'])
                ->andWhere(['NOT IN', 'person_discharge_id', '1'])
                ->count();

        $type3 = \app\modules\pcu\models\Person::find()
                ->where('house_regist_type_id= :house_regist_type_id', [':house_regist_type_id' => '3'])
                ->andWhere(['NOT IN', 'person_discharge_id', '1'])
                ->count();

        $type4 = \app\modules\pcu\models\Person::find()
                ->where('house_regist_type_id= :house_regist_type_id', [':house_regist_type_id' => '4'])
                ->andWhere(['NOT IN', 'person_discharge_id', '1'])
                ->count();

        $edit_in_year = \app\modules\pcu\models\Person::find()
                ->andWhere(['>', 'last_update', $last_update])
                ->andWhere(['NOT IN', 'person_discharge_id', '1'])
                ->count();



        $id = '1';
        $sql = "delete from person_target_detail where hospcode = '$opdconfig' and person_target_index_id = '$id'";
        $this->exec_pcu_master($sql);

        $idkey = $opdconfig . $id;
        $log = new PersonTargetDetail();
        $log->idkey = $idkey;
        $log->b_year = $b_year;
        $log->person_target_index_id = $id;
        $log->type1 = $type1;
        $log->type2 = $type2;
        $log->type3 = $type3;
        $log->type4 = $type4;
        $log->hospcode = $opdconfig;
        $log->all_target = ($type1 + $type2 + $type3 + $type4);
        $log->edit_in_year = $edit_in_year;
        $log->d_update = date('Y-m-d H:i:s');
        $log->save();



        $sql = "select person_vaccine_id from m_person_vaccine ORDER BY person_vaccine_id asc";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $person_vaccine_id = $data['person_vaccine_id'];
        }

        /*
          $sql = "REPLACE INTO testinsert(person_vaccine_id)
          VALUE('$person_vaccine_id')";
          $this->exec_hosxp_pcu($sql);

         */

        $keyid = $opdconfig . '1';

        $sql = "delete from kpi_index_pcu where keyid = '$keyid'";
        $this->exec_pcu_master($sql);


        $sql = "select * from kpi_index_date WHERE id = '1'";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $b_date = $data['b_date'];
            $e_date = $data['e_date'];
            $file_name = $data['file_name'];
        }



        $id_link = '';
        $wait_for_link = '/mreport/pcc/nutrition';

        $sql = "select (select concat(hospitalcode,'1') from opdconfig) as keyid,(select concat(hospitalcode) from opdconfig) as hospcode
,'nutri_614' as file_name
,t2.*,(t2.target-t2.result) as wait_for ,NOW() as d_update

FROM
(select
count(t.person_id) as target
,count( CASE WHEN t.screen_date is not NULL THEN t.person_id end) as result
,round((count( CASE WHEN t.screen_date is not NULL THEN t.person_id end)/count(t.person_id))*100,2) as percent
 FROM
(select t.*,p.pname,p.fname,p.lname,vsc.village_school_class_name,vs.school_name
,(select t2.screen_date from
(select vss.screen_date,vss.village_student_id
FROM village_student_screen vss 
WHERE  vss.screen_date BETWEEN '$b_date'  AND '$e_date' 
GROUP BY vss.village_student_id
)t2 WHERE t2.village_student_id = t.village_student_id) as screen_date
FROM
(select p.person_id,s.village_student_id,s.village_school_id,s.village_school_class_id,TIMESTAMPDIFF(YEAR,p.birthdate,'$e_date') as age_ 
from village_student s 
INNER JOIN person p on p.person_id = s.person_id
WHERE s.discharge not in('Y') AND TIMESTAMPDIFF(YEAR,p.birthdate,'$e_date') BETWEEN 6 AND 14
ORDER BY TIMESTAMPDIFF(YEAR,p.birthdate,'$e_date')  DESC
)t
LEFT JOIN person p on p.person_id = t.person_id
LEFT JOIN village_school_class vsc on vsc.village_school_class_id = t.village_school_class_id
LEFT JOIN village_school vs on vs.village_school_id = t.village_school_id)t)t2";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $keyid = $data['keyid'];
            $hospcode = $data['hospcode'];
            $target = $data['target'];
            $result = $data['result'];
            $percent = $data['percent'];
            $wait_for = $data['wait_for'];
            $d_update = date('Y-m-d H:i:s'); /* $data['d_update']; */
        }
        $sql = "REPLACE INTO kpi_index_pcu(keyid,hospcode,file_name,target,result,percent,wait_for,d_update)
                    VALUE('$keyid','$hospcode','$file_name','$target','$result','$percent','$wait_for','$d_update')";
        $this->exec_pcu_master($sql);


        return $this->redirect(['/pcu/mycount/monitdmscreen']);
    }

    public function actionMonitdmscreen() {
        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;


        $id = '5'; //id kpi

        $keyid = $opdconfig . $id;

        $sql = "delete from kpi_index_pcu where keyid = '$keyid'";
        $this->exec_pcu_master($sql);


        $sql = "select * from kpi_index_date WHERE id = $id";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $b_date = $data['b_date'];
            $e_date = $data['e_date'];
            $b_year = $data['b_year'];
            $file_name = $data['file_name'];
        }


        $sql = "select t2.*,(t2.target - t2.wait_for) as result,round(((t2.target - t2.wait_for)/t2.target)*100,2) as percent,NOW() as d_update FROM
(select '$keyid' as keyid,'$opdconfig' as hospcode,'screendm' as file_name
,count(t.person_dmht_screen_summary_id) target
,count( CASE WHEN t.last_screen_datetime is NULL THEN t.person_dmht_screen_summary_id END) wait_for 
FROM
(select p1.person_dmht_screen_summary_id,p1.person_id,p1.bdg_year,p1.last_screen_datetime
from person_dmht_screen_summary p1  
left outer join person p2 on p2.person_id = p1.person_id 
 left outer join house_regist_type h2 on h2.house_regist_type_id = p2.house_regist_type_id  
left outer join house h1 on h1.house_id = p2.house_id  
left outer join village v on v.village_id = h1.village_id  
left outer join person_dm_screen_status s1 on s1.person_dm_screen_status_id = p1.person_dm_screen_status_id  
left outer join person_ht_screen_status s2 on s2.person_ht_screen_status_id = p1.person_ht_screen_status_id  
left outer join person_stroke_screen_status s3 on s3.person_stroke_screen_status_id = p1.person_stroke_screen_status_id  
left outer join person_obesity_screen_status s4 on s4.person_obesity_screen_status_id = p1.person_obesity_screen_status_id  
left outer join person_dmht_manage_type d1 on d1.person_dmht_manage_type_id = p1.person_dmht_manage_type_id  
where p1.bdg_year = '$b_year' and p1.status_active='Y'  order by v.village_moo,h1.address)t)t2";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $keyid = $data['keyid'];
            $hospcode = $data['hospcode'];
            $target = $data['target'];
            $result = $data['result'];
            $percent = $data['percent'];
            $wait_for = $data['wait_for'];
            $d_update = date('Y-m-d H:i:s'); /* $data['d_update']; */
        }
        $sql = "REPLACE INTO kpi_index_pcu(keyid,hospcode,file_name,target,result,percent,wait_for,d_update)
                    VALUE('$keyid','$hospcode','$file_name','$target','$result','$percent','$wait_for','$d_update')";
        $this->exec_pcu_master($sql);

        return $this->redirect(['/pcu/mycount/monitfollowdmscreen']);
    }

    public function actionMonitfollowdmscreen() {
        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;


        $id = '6'; //id kpi

        $keyid = $opdconfig . $id;

        $sql = "delete from kpi_index_pcu where keyid = '$keyid'";
        $this->exec_pcu_master($sql);


        $sql = "select * from kpi_index_date WHERE id = $id";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $b_date = $data['b_date'];
            $e_date = $data['e_date'];
            $b_year = $data['b_year'];
            $file_name = $data['file_name'];
        }


        $sql = "select t2.*,(t2.target - t2.result) as wait_for,round(((t2.result)/t2.target)*100,2) as percent,NOW() as d_update FROM
(select '$keyid' as keyid,'$opdconfig' as hospcode,'screendm' as file_name
,count( DISTINCT t.person_dmht_screen_summary_id) target
,count( DISTINCT CASE WHEN (t.order_date is NOT NULL AND date(t.last_screen_datetime) < t.order_date) THEN t.person_dmht_screen_summary_id END) result

FROM
(select p1.person_dmht_screen_summary_id,p1.person_id,p1.bdg_year,p1.last_screen_datetime,p2.patient_hn as hn,l.order_date
from person_dmht_screen_summary p1  
INNER JOIN person_dmht_risk_screen_head pd on pd.person_dmht_screen_summary_id = p1.person_dmht_screen_summary_id
left outer join person p2 on p2.person_id = p1.person_id 
 left outer join house_regist_type h2 on h2.house_regist_type_id = p2.house_regist_type_id  
left outer join house h1 on h1.house_id = p2.house_id  
left outer join village v on v.village_id = h1.village_id  
left outer join person_dm_screen_status s1 on s1.person_dm_screen_status_id = p1.person_dm_screen_status_id  
left outer join person_ht_screen_status s2 on s2.person_ht_screen_status_id = p1.person_ht_screen_status_id  
left outer join person_stroke_screen_status s3 on s3.person_stroke_screen_status_id = p1.person_stroke_screen_status_id  
left outer join person_obesity_screen_status s4 on s4.person_obesity_screen_status_id = p1.person_obesity_screen_status_id  
left outer join person_dmht_manage_type d1 on d1.person_dmht_manage_type_id = p1.person_dmht_manage_type_id  
LEFT JOIN (select lh.hn,lh.order_date FROM lab_order lo
INNER JOIN lab_head lh on lh.lab_order_number = lo.lab_order_number 
WHERE lo.lab_items_code = '76')l on l.hn = p2.patient_hn
where p1.bdg_year = '$b_year' and p1.status_active='Y' AND pd.last_fgc >= 126  

order by v.village_moo,h1.address
)t)t2
";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $keyid = $data['keyid'];
            $hospcode = $data['hospcode'];
            $target = $data['target'];
            $result = $data['result'];
            $percent = $data['percent'];
            $wait_for = $data['wait_for'];
            $d_update = date('Y-m-d H:i:s'); /* $data['d_update']; */
        }
        $sql = "REPLACE INTO kpi_index_pcu(keyid,hospcode,file_name,target,result,percent,wait_for,d_update)
                    VALUE('$keyid','$hospcode','$file_name','$target','$result','$percent','$wait_for','$d_update')";
        $this->exec_pcu_master($sql);

        return $this->redirect(['/pcu/mycount/monitrduad']);
    }

    public function actionMonitrduad() {
        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;


        $id = '7'; //id kpi

        $keyid = $opdconfig . $id;

        $sql = "delete from kpi_index_pcu where keyid = '$keyid'";
        $this->exec_pcu_master($sql);


        $sql = "select * from kpi_index_date WHERE id = $id";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $b_date = $data['b_date'];
            $e_date = $data['e_date'];
            $b_year = $data['b_year'];
            $file_name = $data['file_name'];
        }



        $sql = "select t.*,t.d_count as result,round((t.d_count/t.target)*100,2) as percent,NOW() as d_update 
FROM
(select '$keyid' as keyid,'$opdconfig' as hospcode,'screendm' as file_name,count(ovst_diag_id) as target ,null as wait_for
,count(CASE WHEN t.drug is not NULL THEN t.drug end) as d_count
FROM (select o.*, 
(SELECT GROUP_CONCAT(d.`name`) as dname FROM opitemrece op 
INNER JOIN drugitems d on d.icode = op.icode
INNER JOIN drugitems_10918 d1 on d1.icode = d.icode
where vn = o.vn AND d1.check_anti = '1'
GROUP BY op.vn) as drug
FROM ovstdiag o WHERE o.vstdate BETWEEN '$b_date' AND  '$e_date' 
AND icd10 in('A000','A053','A054','A059','A080','A081','A082','A083','A084','A085','A060','A09','A090'
,'A090','A099','K521','K528','K529','A050','A049','A048','A001'
,'A009','A020','A030','A031','A032','A033','A038','A039','A040','A041','A042','A043','A044','A045','A046','A047','A058'))t

)t ";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $keyid = $data['keyid'];
            $hospcode = $data['hospcode'];
            $target = $data['target'];
            $result = $data['result'];
            $percent = $data['percent'];
            $wait_for = $data['wait_for'];
            $d_update = date('Y-m-d H:i:s'); /* $data['d_update']; */
        }
        $sql = "REPLACE INTO kpi_index_pcu(keyid,hospcode,file_name,target,result,percent,wait_for,d_update)
                    VALUE('$keyid','$hospcode','$file_name','$target','$result','$percent','$wait_for','$d_update')";
        $this->exec_pcu_master($sql);

        return $this->redirect(['/pcu/mycount/newver']);
    }

    public function actionNewver() {

        $ver = file_get_contents(Yii::getAlias('../version/version.txt'));
        // $ver = explode(',', $ver);

        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $sql = "UPDATE chospital_amp SET version = '$ver' WHERE hoscode  = '$opdconfig'";
        $this->exec_pcu_master($sql);

        return $this->redirect(['/site/sendsuccess']);
    }

    public function actionMonitreport() {

        $ver = file_get_contents(Yii::getAlias('../version/version.txt'));
        $ver = explode(',', $ver);

        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $keyid = $opdconfig . '5';

        $sql = "delete from kpi_index_pcu where keyid = '$keyid'";
        $this->exec_pcu_master($sql);




        $sql = "select * from kpi_index_date WHERE id = '5'";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $b_date = $data['b_date'];
            $e_date = $data['e_date'];
            $file_name = $data['file_name'];
        }



        return $this->redirect(['/site/sendsuccess']);
    }

    public function actionTestin() {
        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;


        $id = '7'; //id kpi

        $keyid = $opdconfig . $id;

        $sql = "delete from kpi_index_pcu where keyid = '$keyid'";
        $this->exec_pcu_master($sql);


        $sql = "select * from kpi_index_date WHERE /*id = $id */ b_date is not null";
        $data = Yii::$app->db->createCommand($sql)
                
                ->queryAll();
        foreach ($data as $data) {
            // $b_date = $data['b_date'];
            echo  $data['b_date'];
           // $e_date = $data['e_date'];
           // $b_year = $data['b_year'];
            //$file_name = $data['file_name'];
        }


        /*
          $sql = "REPLACE INTO kpi_index_pcu(keyid,hospcode,file_name,target,result,percent,wait_for,d_update)
          VALUE('$keyid','$hospcode','$file_name','$target','$result','$percent','$wait_for','$d_update')";
          $this->exec_pcu_master($sql); */

        //  return $this->redirect(['/pcu/mycount/newver']);
    }

}
