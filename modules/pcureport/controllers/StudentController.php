<?php

namespace app\modules\pcureport\controllers;

use Yii;
use yii\web\Controller;
use app\modules\pcureport\models\HosBasedata;
use app\modules\pcureport\models\HosBasedataSub;
use app\config\components\AppController;
use app\modules\pcu\models\ReportLog;
use app\modules\pcu\models\Opdconfig;
class StudentController extends AppController {

    public function actionIndex() {

        $basedata_id = '5';

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

    public function actionAllnutri614() {

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


        $id = '2';

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

        $sql = "select t.*,p.pname,p.fname,p.lname,vsc.village_school_class_name,vs.school_name
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
LEFT JOIN village_school vs on vs.village_school_id = t.village_school_id";
        $Rawdata = \Yii::$app->db2->createCommand($sql)->queryAll();
        $data = new \yii\data\ArrayDataProvider([
            'allModels' => $Rawdata,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('allnutri614', [
                    'data' => $data,
                    'base_data' => $base_data,
        ]);
    }

    public function actionWaitfornutri614() {
        
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


        $id = '3';

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

        $sql = "select * from(select t.*,p.pname,p.fname,p.lname,vsc.village_school_class_name,vs.school_name
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
LEFT JOIN village_school vs on vs.village_school_id = t.village_school_id)t WHERE t.screen_date is NULL";
        $Rawdata = \Yii::$app->db2->createCommand($sql)->queryAll();
        $data = new \yii\data\ArrayDataProvider([
            'allModels' => $Rawdata,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        return $this->render('waitfornutri614', [
                    'data' => $data,
                    'base_data' => $base_data,
        ]);
    }

}
