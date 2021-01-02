<?php

namespace app\modules\pcureport\controllers;

use Yii;
use yii\web\Controller;
use app\modules\pcureport\models\HosBasedata;
use app\modules\pcureport\models\HosBasedataSub;
use app\config\components\AppController;
use app\modules\pcu\models\ReportLog;
use app\modules\pcu\models\Opdconfig;

/**
 * Default controller for the `pcureport` module
 */
class KpiController extends AppController {

    public $enableCsrfValidation = false;

    public function actionIndex() {

        $basedata_id = '6';

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

    public function actionDental1() {



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


        $id = '5';

        $sql = "select * FROM hos_basedata_sub WHERE id = '$id'";

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();

        foreach ($rawData as $data) {
            // $id = $data['id'];
            $base_data = $data['basedata_sub_name'];
        }
        $code = $opdconfig . 'basedata_sub:' . $data['id'];
        //$base_data = 'tets';

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

        $sql = "SELECT v.vn,p.hn,concat(p.pname,p.fname,'    ',p.lname) as ptname,p.cid,v.age_y,v.vstdate,v.pdx,v.dx_doctor,doc.name as dcotorname,doc.licenseno,concat(v.pttype,' ',y.name)as pttype_send
,if(icd10tm_operation_code='238703A',icd10tm_operation_code,(SELECT icd10tm_operation_code FROM dtmain dtm LEFT OUTER JOIN dttm d on d.`code`=dtm.tmcode  WHERE icd10tm_operation_code ='238703A' and dtm.vn = v.vn  GROUP BY dtm.vn)) as A16
,if(icd10tm_operation_code='238703B',icd10tm_operation_code,(SELECT icd10tm_operation_code FROM dtmain dtm LEFT OUTER JOIN dttm d on d.`code`=dtm.tmcode  WHERE icd10tm_operation_code ='238703B' and dtm.vn = v.vn  GROUP BY dtm.vn)) as B17
,if(icd10tm_operation_code='238703C',icd10tm_operation_code,(SELECT icd10tm_operation_code FROM dtmain dtm LEFT OUTER JOIN dttm d on d.`code`=dtm.tmcode  WHERE icd10tm_operation_code ='238703C' and dtm.vn = v.vn  GROUP BY dtm.vn)) as C26
,if(icd10tm_operation_code='238703D',icd10tm_operation_code,(SELECT icd10tm_operation_code FROM dtmain dtm LEFT OUTER JOIN dttm d on d.`code`=dtm.tmcode  WHERE icd10tm_operation_code ='238703D' and dtm.vn = v.vn  GROUP BY dtm.vn)) as D27
,if(icd10tm_operation_code='238703E',icd10tm_operation_code,(SELECT icd10tm_operation_code FROM dtmain dtm LEFT OUTER JOIN dttm d on d.`code`=dtm.tmcode  WHERE icd10tm_operation_code ='238703E' and dtm.vn = v.vn  GROUP BY dtm.vn)) as E36
,if(icd10tm_operation_code='238703F',icd10tm_operation_code,(SELECT icd10tm_operation_code FROM dtmain dtm LEFT OUTER JOIN dttm d on d.`code`=dtm.tmcode  WHERE icd10tm_operation_code ='238703F' and dtm.vn = v.vn  GROUP BY dtm.vn)) as F37
,if(icd10tm_operation_code='238703G',icd10tm_operation_code,(SELECT icd10tm_operation_code FROM dtmain dtm LEFT OUTER JOIN dttm d on d.`code`=dtm.tmcode  WHERE icd10tm_operation_code ='238703G' and dtm.vn = v.vn  GROUP BY dtm.vn)) as G46
,if(icd10tm_operation_code='238703H',icd10tm_operation_code,(SELECT icd10tm_operation_code FROM dtmain dtm LEFT OUTER JOIN dttm d on d.`code`=dtm.tmcode  WHERE icd10tm_operation_code ='238703H' and dtm.vn = v.vn  GROUP BY dtm.vn)) as H47
,if(icd10tm_operation_code='2377020',icd10tm_operation_code,(SELECT icd10tm_operation_code FROM dtmain dtm LEFT OUTER JOIN dttm d on d.`code`=dtm.tmcode  WHERE icd10tm_operation_code ='2377020' and dtm.vn = v.vn  GROUP BY dtm.vn)) as Flu1
,if(icd10tm_operation_code='2377021',icd10tm_operation_code,(SELECT icd10tm_operation_code FROM dtmain dtm LEFT OUTER JOIN dttm d on d.`code`=dtm.tmcode  WHERE icd10tm_operation_code ='2377021' and dtm.vn = v.vn  GROUP BY dtm.vn)) as Flu2
from dttm d 
left outer join dtmain t on d.`code`=t.tmcode
left outer join patient p on p.hn=t.hn
left outer join vn_stat v on v.vn=t.vn
left outer join pttype y on y.pttype = v.pttype
LEFT OUTER JOIN doctor doc on doc.code = v.dx_doctor
where t.vstdate between '$date1' and '$date2' and d.icd10tm_operation_code
in ('238703A','238703B','238703C','238703D','238703E','238703F','238703G','238703H','2377020','2377021')
GROUP BY v.vn";
        $Rawdata = \Yii::$app->db2->createCommand($sql)->queryAll();
        $data = new \yii\data\ArrayDataProvider([
            'allModels' => $Rawdata,
            'pagination' => [
                'pageSize' => FALSE,
            ],
        ]);

        return $this->render('dental1', [
                    'data' => $data,
                    'base_data' => $base_data,
                    'date1' => $date1,
                    'date2' => $date2,
        ]);
    }

    public function actionRduAd() {

        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $sql = "select * from kpi_index_date WHERE id = '7'";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $b_date = $data['b_date'];
            $e_date = $data['e_date'];
            $file_name = $data['file_name'];
        }


        $id = '11';

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

        $sql = "select t.*
,(SELECT GROUP_CONCAT(d.`name`) as dname FROM opitemrece op 
INNER JOIN drugitems d on d.icode = op.icode
INNER JOIN drugitems_10918 d1 on d1.icode = d.icode
where vn = t.vn 
GROUP BY op.vn) as drug,
CASE WHEN (SELECT GROUP_CONCAT(d.`name`) as dname FROM opitemrece op 
INNER JOIN drugitems d on d.icode = op.icode
INNER JOIN drugitems_10918 d1 on d1.icode = d.icode
where vn = t.vn AND d1.check_anti = '1'
GROUP BY op.vn) is not null then '/' 
ELSE '-' END as check_drug
FROM
(
select t.*,GROUP_CONCAT(ov.icd10) as all_icd FROM
(select vn,hn,vstdate,vsttime,icd10
FROM ovstdiag WHERE vstdate BETWEEN '$b_date' AND  '$e_date' 
AND icd10 in('A000','A053','A054','A059','A080','A081','A082','A083','A084','A085','A060','A09','A090'
,'A090','A099','K521','K528','K529','A050','A049','A048','A001'
,'A009','A020','A030','A031','A032','A033','A038','A039','A040','A041','A042','A043','A044','A045','A046','A047','A058')
GROUP BY vn)t INNER JOIN ovstdiag ov on ov.vn = t.vn
GROUP BY ov.vn
)t
GROUP BY t.vn";
        $Rawdata = \Yii::$app->db2->createCommand($sql)->queryAll();
        $data = new \yii\data\ArrayDataProvider([
            'allModels' => $Rawdata,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('rdu-ad', [
                    'data' => $data,
                    'base_data' => $base_data,
        ]);
    }

    public function actionHba1cR1() {



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


        $id = '12';

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

        $sql = "select concat(date_format(lh.order_date,'%d-%m-'),date_format(lh.order_date,'%Y')+543) as order_date,lh.hn,t.lab_order_result 
from lab_head lh
INNER JOIN clinicmember cl on cl.hn = lh.hn AND cl.clinic = '001'
INNER JOIN
(select lab_order_number,lab_order_result
FROM lab_order l
WHERE lab_items_code in
(select lab_items_code from lab_items WHERE lab_items_name LIKE'%hba1c%')
AND lab_order_result is not NULL AND cast(lab_order_result as INT) >= 7)t on t.lab_order_number = lh.lab_order_number
WHERE lh.order_date BETWEEN '$date1' AND  '$date2' order by lh.order_date asc";
        $Rawdata = \Yii::$app->db2->createCommand($sql)->queryAll();
        $data = new \yii\data\ArrayDataProvider([
            'allModels' => $Rawdata,
            'pagination' => false/* [
                  'pageSize' => 50,
                  ], */
        ]);

        return $this->render('hba1c-r1', [
                    'data' => $data,
                    'base_data' => $base_data,
                    'date1' => $date1,
                    'date2' => $date2,
        ]);
    }

    public function actionSp9To60() {



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


        $id = '13';

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


        $sql = "select s1.pid,concat(p.pname,p.fname,' ',p.lname) as ptname

,concat(h.address,' หมู่ ',v.village_moo,' บ้าน ',v.village_name) as vname
,s1.agemonth,s1.date_start,s1.date_end 
from person p 
LEFT JOIN village v on v.village_id = p.village_id
LEFT JOIN house h on h.house_id = p.house_id
INNER JOIN t_childdev_specialpp s1 on s1.cid = p.cid
WHERE date(NOW()) BETWEEN s1.date_start AND date_end
AND date_serv_first is NULL
ORDER BY CAST(s1.agemonth as int) desc";
        $Rawdata = \Yii::$app->db2->createCommand($sql)->queryAll();
        $data = new \yii\data\ArrayDataProvider([
            'allModels' => $Rawdata,
            'pagination' => false/* [
                  'pageSize' => 50,
                  ], */
        ]);

        return $this->render('sp9-to60', [
                    'data' => $data,
                    'base_data' => $base_data,
        ]);
    }

    public function actionPanthai() {



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


        $id = '14';

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


        $sql = "select concat(date_format(t.service_date,'%d/%m/'),date_format(t.service_date,'%Y')+543) as service_date,t.hn
,(select health_med_treatment_subtype_name from health_med_treatment_subtype where health_med_treatment_subtype_id = t.health_med_treatment_subtype_id) as main
,(select health_med_operation_item_name from health_med_operation_item 
WHERE health_med_operation_item_id = hs.health_med_operation_item_id) as hname
,if(hs.health_med_organ_id>0,'/','-') as check_
FROM
(SELECT hm.health_med_treatment_type_name,hms.health_med_treatment_subtype_id,hs.* 
from health_med_service hs
LEFT JOIN health_med_treatment_type hm on hm.health_med_treatment_type_id = hs.health_med_treatment_type_id
LEFT JOIN health_med_service_treatment hms on hms.health_med_service_id = hs.health_med_service_id
LEFT JOIN ovstdiag o on o.vn = hs.vn
WHERE o.icd10 LIKE'U%'
AND hs.service_date BETWEEN '$date1' AND '$date2')t
LEFT JOIN health_med_service_operation hs on hs.health_med_service_id = t.health_med_service_id";
        $Rawdata = \Yii::$app->db2->createCommand($sql)->queryAll();
        $data = new \yii\data\ArrayDataProvider([
            'allModels' => $Rawdata,
            'pagination' => false/* [
                  'pageSize' => 50,
                  ], */
        ]);

        return $this->render('panthai', [
                    'data' => $data,
                    'base_data' => $base_data,
                    'date1' => $date1,
                    'date2' => $date2,
        ]);
    }
	
	public function actionChilddevSpecialpp() {



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


        $id = '19';

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

        return $this->render('childdev-specialpp', [
                    'data' => $data,
                    'base_data' => $base_data,
        ]);
    }
	
	public function actionFollowScreendm() {



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


        $id = '20';

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
		
		$sql2 = "select t.*,(select GROUP_CONCAT(form_name) as form FROM lab_form WHERE lab_items_code = t.lab_items_code GROUP BY lab_items_code) as lab_form
FROM
(select l.lab_items_code,l.lab_items_name,lg.lab_items_group_name 
from lab_items l
LEFT JOIN lab_items_group lg on lg.lab_items_group_code = l.lab_items_group
WHERE l.provis_labcode = '0531002')t
";
        $Rawdata  = Yii::$app->db2->createCommand($sql2)->queryAll();
        $data2 = new \yii\data\ArrayDataProvider([
            'allModels' => $Rawdata,
            'pagination' => false/* [
                  'pageSize' => 50,
                  ], */
        ]);

        $data = Yii::$app->request->post();


        $sql = "select concat(hdc_folow_dm.NAME,' ',LNAME) as ptname,if(SEX = '1','ชาย','หญิง') as sex2,hdc_folow_dm.* 
		,concat(ADDRESS,' หมู่ ' ,mid(hdc_folow_dm.VHID,7,2),' ',th.full_name) as addr

		,concat(date_format(BIRTH,'%d/%m/'),date_format(BIRTH,'%Y')+543) as birthdate
		from hdc_folow_dm
		LEFT JOIN thaiaddress th on th.addressid = mid(hdc_folow_dm.VHID,1,6)
WHERE confirm_date = '' AND HOSPCODE = '$opdconfig'";
        $Rawdata = \Yii::$app->db->createCommand($sql)->queryAll();
        $data = new \yii\data\ArrayDataProvider([
            'allModels' => $Rawdata,
            'pagination' => false/* [
                  'pageSize' => 50,
                  ], */
        ]);

        return $this->render('follow-screendm', [
                    'data' => $data,
                    'base_data' => $base_data,
					'data2' => $data2,
					
        ]);
    }

}
