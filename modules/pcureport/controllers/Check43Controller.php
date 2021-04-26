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
class Check43Controller extends AppController {

    protected function exec_pcu_master($sql = NULL) {
        return \Yii::$app->db->createCommand($sql)->execute();
    }

    protected function exec_hosxp_pcu($sql = NULL) {
        return \Yii::$app->db2->createCommand($sql)->execute();
    }

    public function actionIndex() {

        $basedata_id = '9';

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

   public function actionCheckperson() {

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


        $id = '31';

        $sql = "select * FROM hos_basedata_sub WHERE id = '$id'";

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();

        foreach ($rawData as $data) {
            // $id = $data['id'];
            $base_data = $data['basedata_sub_name'];
        }
         $code = $opdconfig.'basedata_sub:'.$data['id'];
                 
        $log = new ReportLog();
        $log->code_data = $code;
        $log->user_id = \Yii::$app->user->identity->id;
        $log->datetime = date('Y-m-d H:i:s');
        // $log->data_index_id = $id;
        $log->ip = \Yii::$app->request->getUserIP();
        $log->save();

        $sql = "select * FROM
(select p.person_id PID
,p.cid
,ifnull(p.patient_hn,'X') HN
,h.house_id HID
,if(pn.provis_code is null,'X',p.pname) PreName
,p.pname
,p.fname Name 
,p.lname Lname 
,case 
when p.sex is null then 'X'
when p.sex = 1 then 'ชาย'
when p.sex = 2 then 'หญิง'
end as sex
,ifnull(p.birthdate,'X') birth
,if(p.marrystatus in (1,2,3,4,5,6),p.marrystatus,'9') Mstatus
,ifnull(o.occupation,'000') Occupation_Old
,ifnull(o.nhso_code,'9999') Occupation_New
,ifnull(nt1.nhso_code,'099') Race
,ifnull(nt0.nhso_code,'099') Nation
,ifnull(p.religion,'01') Religion
,if(e.provis_code is null,'9',e.provis_code) Education
,if(p.person_house_position_id=1,'1','2') Fstatus
,p.father_cid Father
,p.mother_cid Mother
,p.sps_cid Couple
,' ' Vstatus
,date(p.movein_date) MoveIn
,ifnull(p.person_discharge_id,'9') Discharge
,date(p.discharge_date) Ddischarge

,@blood:=substring_index(p.blood_group,'-',1) blood_group
,case 
when @blood='A' then '1'
when @blood='B' then '2'
when @blood='AB' then '3'
when @blood='O' then '4'
else '9' end BloodGroup
,p.bloodgroup_rh Rh

,pl.nhso_code Labor
,space(8) PassPort
,if(p.house_regist_type_id in (1,2,3,4,5),p.house_regist_type_id,'X') TypeArea
,p.last_update D_Update
,p.home_phone telephone 
,p.mobile_phone mobile 

from person p
left join house h on p.house_id=h.house_id
left join pname pn on pn.name=p.pname
left join occupation o on o.occupation=p.occupation
left join nationality nt0 on nt0.nationality=p.citizenship
left join nationality nt1 on nt1.nationality=p.nationality
left join provis_religion r on r.code=p.religion
left join education e on e.education=p.education
left join person_labor_type pl on pl.person_labor_type_id=p.person_labor_type_id
)t WHERE ((t.PreName ='X') 
or (t.HN ='X') 
or (t.birth ='X')
or (t.Mstatus ='X')
or (t.sex ='X')
or (t.TypeArea ='X')
)
";
        
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

        return $this->render('checkperson', [
                    'data' => $data,
                    'base_data' => $base_data,
        ]);
    }
    public function actionCheckpatient() {

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


        $id = '31';

        $sql = "select * FROM hos_basedata_sub WHERE id = '$id'";

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();

        foreach ($rawData as $data) {
            // $id = $data['id'];
            $base_data = $data['basedata_sub_name'];
        }
         $code = $opdconfig.'basedata_sub:'.$data['id'];
                 
        $log = new ReportLog();
        $log->code_data = $code;
        $log->user_id = \Yii::$app->user->identity->id;
        $log->datetime = date('Y-m-d H:i:s');
        // $log->data_index_id = $id;
        $log->ip = \Yii::$app->request->getUserIP();
        $log->save();

        $sql = "select * FROM
(select p.person_id PID
,p.cid
,ifnull(p.patient_hn,'X') HN
,h.house_id HID
,if(pn.provis_code is null,'X',p.pname) PreName
,p.pname
,p.fname Name 
,p.lname Lname 
,case 
when p.sex is null then 'X'
when p.sex = 1 then 'ชาย'
when p.sex = 2 then 'หญิง'
end as sex
,ifnull(p.birthdate,'X') birth
,if(p.marrystatus in (1,2,3,4,5,6),p.marrystatus,'9') Mstatus
,ifnull(o.occupation,'000') Occupation_Old
,ifnull(o.nhso_code,'9999') Occupation_New
,ifnull(nt1.nhso_code,'099') Race
,ifnull(nt0.nhso_code,'099') Nation
,ifnull(p.religion,'01') Religion
,if(e.provis_code is null,'9',e.provis_code) Education
,if(p.person_house_position_id=1,'1','2') Fstatus
,p.father_cid Father
,p.mother_cid Mother
,p.sps_cid Couple
,' ' Vstatus
,date(p.movein_date) MoveIn
,ifnull(p.person_discharge_id,'9') Discharge
,date(p.discharge_date) Ddischarge

,@blood:=substring_index(p.blood_group,'-',1) blood_group
,case 
when @blood='A' then '1'
when @blood='B' then '2'
when @blood='AB' then '3'
when @blood='O' then '4'
else '9' end BloodGroup
,p.bloodgroup_rh Rh

,pl.nhso_code Labor
,space(8) PassPort
,if(p.house_regist_type_id in (1,2,3,4,5),p.house_regist_type_id,'X') TypeArea
,p.last_update D_Update
,p.home_phone telephone 
,p.mobile_phone mobile 

from person p
left join house h on p.house_id=h.house_id
left join pname pn on pn.name=p.pname
left join occupation o on o.occupation=p.occupation
left join nationality nt0 on nt0.nationality=p.citizenship
left join nationality nt1 on nt1.nationality=p.nationality
left join provis_religion r on r.code=p.religion
left join education e on e.education=p.education
left join person_labor_type pl on pl.person_labor_type_id=p.person_labor_type_id
)t WHERE ((t.PreName ='X') 
or (t.HN ='X') 
or (t.birth ='X')
or (t.Mstatus ='X')
or (t.sex ='X')
or (t.TypeArea ='X')
)
";
        
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

        return $this->render('checkpatient', [
                    'data' => $data,
                    'base_data' => $base_data,
        ]);
    }

}
