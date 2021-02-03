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
class DefaultController extends Controller
{

    protected function exec_hosxp_pcu($sql = NULL) {
        return \Yii::$app->db2->createCommand($sql)->execute();
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionMain()
    {
        return $this->render('main');
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
        
      return $this->redirect(['/pcureport/default/main']);
//Yii::$app->getSession()->setFlash('success', 'ประมวลผลเรียบร้อยแล้ว!! ');
        //  return $this->redirect(['/site/process-success']);
    }

    public function actionWscChronicLab() {

        $sql = file_get_contents(__DIR__ . '/sql/wsc_chronic_lab.sql');
        $command = Yii::$app->db2->createCommand($sql);
        $command->execute();

        // Make sure, we fetch all errors
        while ($command->pdoStatement->nextRowSet()) {}

        $sql0 = "REPLACE INTO wsc_chronic_lab
        select (select hospitalcode from opdconfig limit 1) as hoscode
        ,upper(md5(concat('r9',cid,'refer#09'))) as cid_encrypt
        ,p.hn,order_date, 'chronic_lab' as uuid from lab_order o
        LEFT OUTER JOIN lab_head h on o.lab_order_number=h.lab_order_number
        LEFT OUTER JOIN lab_items i on o.lab_items_code=i.lab_items_code
        LEFT OUTER JOIN patient p on h.hn=p.hn
        where  p.hn in(select hn from clinicmember WHERE clinic in('001','002'))
        AND TIMESTAMPDIFF(MONTH,order_date,NOW()) < 2
        GROUP BY concat(p.hn,order_date)";
          $this->exec_hosxp_pcu($sql0); 

        Yii::$app->getSession()->setFlash('success', 'ดำเนินการเรียบร้อยแล้ว!! ');
        
      return $this->redirect(['/pcureport/default/main']);
    }

    public function actionChronicLab() {
        
        
        $opd = Opdconfig::find()
        ->one();
$opdconfig = $opd->hospitalcode;

$id = '28'; //เลขจากตาราง hos_basedata_sub
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
  
                $sql = "select l.*,l.cid_encrypt as cid,concat(pt.pname,pt.fname,' ',pt.lname) as ptname from wsc_chronic_lab l
                INNER JOIN patient pt on pt.hn = l.hn
                WHERE TIMESTAMPDIFF(day,order_date,NOW()) < 10";
                try {
                $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
            } catch (\yii\db\Exception $e) {
                throw new \yii\web\ConflictHttpException('sql error');
            }
                $t = new \yii\data\ArrayDataProvider([
                    'allModels' => $rawData,
                    'pagination' => [
                        'pageSize' => 50,
                    ],
                ]);
            } 

        

        return $this->render('chronic-lab', [
                    't' => $t,
                   // 'basedata_id' => $basedata_id,
                    // 'id' => $id,
                    'base_data' => $base_data,
                    
        ]);
    }
}
