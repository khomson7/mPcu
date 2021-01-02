<?php

namespace app\modules\pcu\controllers;

use Yii;
use app\modules\pcu\models\MOpdAllergy;
use app\modules\pcu\models\MOpdAllergySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\pcu\models\Patient;
use app\modules\pcu\models\ReportLog;
use app\modules\pcu\models\CountDataPcu;
use app\modules\pcu\models\OpdAllergy;
use app\modules\pcu\models\Opdconfig;
use app\config\components\AppController;

/**
 * MOpdAllergyController implements the CRUD actions for MOpdAllergy model.
 */
class MOpdAllergyController extends AppController {

    /**
     * {@inheritdoc}
     */
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

    protected function exec_hosxp_pcu($sql = NULL) {
        return \Yii::$app->db2->createCommand($sql)->execute();
    }
    
    
    
     public function actionOpdAllergyapi() {
        
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
                    CURLOPT_URL => "$url/persons/opdallergy", //เปลี่ยนแปลง
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
                    $hn = $value['hn'];
                    $report_date = $value['report_date'];
                    $agent = $value['agent'];
                    $symptom = $value['symptom2'];
                    $reporter = $value['reporter'];
                    $note = $value['note2'];
                    $begin_date = $value['begin_date_'];
                    $entry_datetime = $value['entry_datetime'];
                    $update_datetime = $value['update_datetime'];
                    $patient_cid = $value['patient_cid'];
                    $allergy_group_id = $value['allergy_group_id'];
                    $seriousness_id = $value['seriousness_id'];
                    $allergy_result_id = $value['allergy_result_id'];
                    $allergy_relation_id = $value['allergy_relation_id'];
                     $force_no_order = $value['force_no_order'];
                     $agent_code24 = $value['agent_code24'];
                     
                                     
                        $sql = "REPLACE INTO opd_allergy_10918(hn,report_date,agent,symptom,reporter,note,begin_date,entry_datetime,update_datetime
                            ,patient_cid,allergy_group_id,seriousness_id,allergy_result_id,allergy_relation_id,agent_code24)
                    VALUE('$hn','$report_date','$agent','$symptom','$reporter','$note','$begin_date','$entry_datetime','$update_datetime'
                                ,'$patient_cid','$allergy_group_id','$seriousness_id','$allergy_result_id','$allergy_relation_id','$agent_code24')";
                        $this->exec_hosxp_pcu($sql);
                    
                }

            $sql2 = "call mpcu_opd_allergy_importpcu";
                /*
                $sql2 = "INSERT INTO opd_allergy(hn,report_date,agent,symptom,reporter,note
,allergy_group_id,seriousness_id,allergy_result_id,allergy_relation_id,entry_datetime,update_datetime
,opd_allergy_alert_type_id,patient_cid,opd_allergy_report_type_id)

select pt.hn,a.report_date,a.agent,a.symptom,a.reporter,a.note
,a.allergy_group_id,a.seriousness_id,a.allergy_result_id,a.allergy_relation_id,a.entry_datetime,NOW() as update_datetime
,a.opd_allergy_alert_type_id,a.patient_cid,a.opd_allergy_report_type_id
from opd_allergy_10918 a
INNER JOIN patient pt on pt.cid = a.patient_cid
WHERE concat(pt.hn,a.agent) not in(select concat(hn,agent) FROM opd_allergy)"; */
                
             $this->exec_hosxp_pcu($sql2);
             
            } catch (\Exception $e) {                //echo "ท่านไม่ได้รับสิทธ";
                return $this->redirect(['/site/api-err']);
            }
        }
     
       $this->notify_allergy('นำเข้าข้อมูลแพ้ยาสำเร็จ');
        return $this->render('opd-allergyapi', [
                 
        ]);
       
    }
    
    

    /**
     * Lists all MOpdAllergy models.
     * @return mixed
     */
    public function actionIndextest() {

        $sql = "select cid from patient where cid is not null and mid(cid,2,5) not in(select hospitalcode from opdconfig)";
        // $query = OpdAllergy::find()->select('patient_cid')
        //         ->all();
        $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();

        echo '<pre>';
        print_r($rawData);
        echo '</pre>';
        ;
    }

    public function actionIndexreplace() {

        $sql = "select hn FROM patient limit 61";
        // $query = OpdAllergy::find()->select('patient_cid')
        //         ->all();
        $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();

        echo '<pre>';
        print_r($rawData);
        echo '</pre>';
    }

    public function actionIndex() {
        $sql = "SELECT SQL_BIG_RESULT  * from opd_allergy 
";


        $rawData = \Yii::$app->db2->createCommand($sql)
                ->queryAll();


        $searchModel = new MOpdAllergySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //  $rawData = ['3440601127944','3440601127944','3240800251213'];
        // $dataProvider->query->where('patient_cid = :patient_cid', [':patient_cid' => $patient]);
        //  $dataProvider->query->where(['NOT IN', 'patient_cid', [$rawData]]);


        return $this->render('index', [
                    'sql' => $sql,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex2() {

        $rows = Patient::find()
                ->select(['cid'])
                //  ->where('username_id = :username_id', [':username_id' => $user_id])
                ->all();

        foreach ($rows as $rows) {

            //  $token_= $rows['token_'];
            $patient = $rows['cid'];
        }



        $data = Yii::$app->request->post();


        $sql = "select patient_cid,hn,agent FROM m_opd_allergy where patient_cid in ([$patient])

";


        $rawData = \Yii::$app->db->createCommand($sql)
                ->queryAll();
        $person = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);


        return $this->render('index', [
                    /* 'hospcode'=>$hospcode, */
                    'person' => $person,
                    'sql' => $sql,
        ]);
    }

    /**
     * Displays a single MOpdAllergy model.
     * @param string $hn
     * @param string $agent
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*
      public function actionView($hn, $agent) {
      return $this->render('view', [
      'model' => $this->findModel($hn, $agent),
      ]);
      }
     */
    /**
     * Creates a new MOpdAllergy model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
      public function actionCreate() {
      $model = new MOpdAllergy();

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'hn' => $model->hn, 'agent' => $model->agent]);
      }

      return $this->render('create', [
      'model' => $model,
      ]);
      }
     */

    /**
     * Updates an existing MOpdAllergy model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $hn
     * @param string $agent
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    
     public function actionTestline(){
         $this->notify_allergy('testline');
    }
    
    public function actionUpdate($hn, $agent2) {
        $model = $this->findModel($hn, $agent2);

        if ($model->load(Yii::$app->request->post())) {
            $req = \Yii::$app->request;
            $post = $req->post();


            $hn = $post['MOpdAllergy'] ['hn'];
            //$report_date = $post['MOpdAllergy'] ['report_date'];
            $report_date = date('Y-m-d');
            $agent = $post['MOpdAllergy'] ['agent'];
            $symptom = $post['MOpdAllergy'] ['symptom'];
            $reporter = $post['MOpdAllergy'] ['reporter'];
         //   $relation_level = $post['MOpdAllergy'] ['relation_level'];
            $note = $post['MOpdAllergy'] ['note'];
          //  $allergy_type = $post['MOpdAllergy'] ['allergy_type'];
          //  $display_order = $post['MOpdAllergy'] ['display_order'];
           // $begin_date = $post['MOpdAllergy'] ['begin_date'];
            $allergy_group_id = $post['MOpdAllergy'] ['allergy_group_id'];
            $seriousness_id = $post['MOpdAllergy'] ['seriousness_id'];
            $allergy_result_id = $post['MOpdAllergy'] ['allergy_result_id'];
            $allergy_relation_id = $post['MOpdAllergy'] ['allergy_relation_id'];
           // $ward = $post['MOpdAllergy'] ['ward'];
          //  $department = $post['MOpdAllergy'] ['department'];
           // $spclty = $post['MOpdAllergy'] ['spclty'];
            $entry_datetime = $post['MOpdAllergy'] ['entry_datetime'];
            $update_datetime = date('Y-m-d H:i:s');
           // $depcode = $post['MOpdAllergy'] ['depcode'];
         //   $no_alert = $post['MOpdAllergy'] ['no_alert'];
          //  $naranjo_result_id = $post['MOpdAllergy'] ['naranjo_result_id'];
          //  $force_no_order = $post['MOpdAllergy'] ['force_no_order'];
            $opd_allergy_alert_type_id = $post['MOpdAllergy'] ['opd_allergy_alert_type_id'];
         //   $hos_guid = $post['MOpdAllergy'] ['hos_guid'];
         //   $adr_preventable_score = $post['MOpdAllergy'] ['adr_preventable_score'];
        //    $preventable = $post['MOpdAllergy'] ['preventable'];
            $patient_cid = $post['MOpdAllergy'] ['patient_cid'];
         //   $adr_consult_dialog_id = $post['MOpdAllergy'] ['adr_consult_dialog_id'];
            $opd_allergy_report_type_id = $post['MOpdAllergy'] ['opd_allergy_report_type_id'];
         //   $hos_guid_ext = $post['MOpdAllergy'] ['hos_guid_ext'];
        //    $agent_code24 = $post['MOpdAllergy'] ['agent_code24'];
        //    $officer_confirm = $post['MOpdAllergy'] ['officer_confirm'];
         //   $icode = $post['MOpdAllergy'] ['icode'];
         //   $opd_allergy_symtom_type_id = $post['MOpdAllergy'] ['opd_allergy_symtom_type_id'];
        //    $opd_allergy_id = $post['MOpdAllergy'] ['opd_allergy_id'];
         //   $cross_group_check = $post['MOpdAllergy'] ['cross_group_check'];
         //   $opd_allergy_source_id = $post['MOpdAllergy'] ['opd_allergy_source_id'];
        //    $opd_allergy_type_id = $post['MOpdAllergy'] ['opd_allergy_type_id'];
         //   $doctor_code = $post['MOpdAllergy'] ['doctor_code'];
         //   $dosage_text = $post['MOpdAllergy'] ['dosage_text'];
         //   $usage_text = $post['MOpdAllergy'] ['usage_text'];
        //    $lab_text = $post['MOpdAllergy'] ['lab_text'];


            $sql = "REPLACE INTO opd_allergy_10918(hn,report_date,agent,symptom,reporter,note
,allergy_group_id,seriousness_id,allergy_result_id,allergy_relation_id,entry_datetime,update_datetime
,opd_allergy_alert_type_id,patient_cid,opd_allergy_report_type_id)
                    VALUE('$hn','$report_date','$agent','$symptom','$reporter','$note','$allergy_group_id','$seriousness_id','$allergy_result_id'
,'$allergy_relation_id','$entry_datetime','$update_datetime','$opd_allergy_alert_type_id','$patient_cid','$opd_allergy_report_type_id')";
            $this->exec_hosxp_pcu($sql);
            
            $sql2 = "call mpcu_opd_allergy_importpcu";
             $this->exec_hosxp_pcu($sql2);


            if (\Yii::$app->request->isPost) {

                $id = '12';
                $log = new ReportLog();
                $log->code_data = '{HN=>' . $hn . '}{Agent=>' . $agent . '}';
                $log->user_id = \Yii::$app->user->identity->id;
                $log->datetime = date('Y-m-d H:i:s');
                $log->data_index_id = $id;
                $log->ip = \Yii::$app->request->getUserIP();
                $log->save();

                /*
                  $sql = "delete from count_data_pcu where hosp_code = '$opdconfig' and data_id = '$id'";
                  $this->exec_pcu_master($sql);

                  $idkey = $opdconfig.$id;
                  $log = new CountDataPcu();
                  $log->idkey = $idkey;
                  $log->count_data = $query;
                  $log->data_id = $id;
                  $log->datetime = date('Y-m-d H:i:s');
                  $log->hosp_code = $opdconfig;
                  $log->ip = \Yii::$app->request->getUserIP();
                  $log->save();
                 * */
            }

            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
                    'model' => $model,
        ]);
    }
	
	 public function actionUpProcess() {
		 
		$searchModel = new MOpdAllergySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		 $sql = "call mpcu_opd_allergy_importpcu";
        $this->exec_hosxp_pcu($sql);
		
		Yii::$app->getSession()->setFlash('success', 'ประมวลผลเรียบร้อยแล้ว!! ');
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
  
    }
	

    /**
     * Deletes an existing MOpdAllergy model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $hn
     * @param string $agent
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*
      public function actionDelete($hn, $agent) {
      $this->findModel($hn, $agent)->delete();

      return $this->redirect(['index']);
      }
     */

    /**
     * Finds the MOpdAllergy model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $hn
     * @param string $agent
     * @return MOpdAllergy the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($hn, $agent2) {
        if (($model = MOpdAllergy::findOne(['hn' => $hn, 'agent2' => $agent2])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
     public function notify_allergy($message) {
  
        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $rows = (new \yii\db\Query())
                ->select(['line_token'])
                ->from('chospital_amp')
                ->where('hoscode = :hoscode', [':hoscode' => $opdconfig])
                ->all();

        foreach ($rows as $rows) {

            $line_token = $rows['line_token'];

            $line_api = 'https://notify-api.line.me/api/notify';
            $queryData = array('message' => $message);
            $queryData = http_build_query($queryData, '', '&');

            $headerOptions = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                    . "Authorization: Bearer " . $line_token . "\r\n"
                    . "Content-Length: " . strlen($queryData) . "\r\n",
                    'content' => $queryData,
                ),
            );


            $context = stream_context_create($headerOptions);
            $result = file_get_contents($line_api, FALSE, $context);
        }
        $res = json_decode($result);
        return $res;
    }

}
