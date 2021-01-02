<?php

namespace app\modules\pcu\controllers;

use Yii;
use yii\base\Model;
use app\modules\pcu\models\Drugitems;
use app\modules\pcu\models\Mdrugitems;
use app\modules\pcu\models\MdrugitemsSearch2;
use app\modules\pcu\models\MdrugitemsSearch;
use app\modules\pcu\models\MdrugitemsUpdate;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\pcu\models\MsDrugitems;
use app\config\components\AppController;
use app\modules\pcu\models\ReportLog;
use app\modules\pcu\models\Opdconfig;
use app\modules\pcu\models\CountDataPcu;

/**
 * MdrugitemsController implements the CRUD actions for Mdrugitems model.
 */
class MdrugitemsController extends AppController {

    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    /*
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
     */

    protected function exec_pcu_master($sql = NULL) {
        return \Yii::$app->db->createCommand($sql)->execute();
    }

    protected function exec_hosxp_pcu($sql = NULL) {
        return \Yii::$app->db2->createCommand($sql)->execute();
    }

    protected function exec_center($sql = NULL) {
        return \Yii::$app->db3->createCommand($sql)->execute();
    }

    protected function exec_datacenter($sql = NULL) {

        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://127.0.0.1:3012/userdbs/login2",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{\r\n\"email\":\"userdb@test.com\",\r\n\"password\":\"##Psdb##\"\r\n}",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            ));

            $response = curl_exec($curl);

            $data = '{
    "success": 1,
    "data": [' . $response . ']
}';
            curl_close($curl);

            //  echo $response;
            if (!$response) {
                //  return $this->redirect('api-error');
            }

            $json_api0 = json_decode($data, true);
            foreach ($json_api0['data'] as $value) {
                $token = $value['token'];
            }
        } catch (\Exception $e) {

            echo "เกิดปัญหาการเชื่อมต่อ API";
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://127.0.0.1:3012/userdbs/servcon",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

// $jsonurl = "$url/ppspecials/$b_date/$user";
//  $json = file_get_contents($response);  
        $json_api0 = json_decode($response, true);

        foreach ($json_api0['data'] as $key => $item) {
            $mydns = $item['dns'];
            $myusername = $item['username'];
            $mypassword = $item['dbpassword'];
        }
    }

    /**
     * Lists all Mdrugitems models.
     * @return mixed
     */
    public function actionTestapi() {

        $sql = "select (select hospitalcode from opdconfig) as hospcode,p.cid,LPAD(p.person_id,6,'0') as PID,
            house_id as HID,
(select provis_code FROM pname WHERE name = p.pname ) as PRENAME
,fname,lname,patient_hn as HN,sex as SEX,birthdate as BIRTH,marrystatus as MSTATUS,last_update
,person_discharge_id,house_regist_type_id,nationality,discharge_date
 from  person p limit 1000";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $HOSPCODE = $data['hospcode'];
            $CID = $data['cid'];
            $PID = $data['PID'];
            $HID = $data['HID'];
            $PRENAME = $data['PRENAME'];
            $NAME = $data['fname'];
            $LNAME = $data['lname'];
            $HN = $data['HN'];
            $SEX = $data['SEX'];
            $BIRTH = $data['BIRTH'];
            $MSTATUS = $data['MSTATUS'];
            $NATION = $data['nationality'];
            $DISCHARGE = $data['person_discharge_id'];
            $DDISCHARGE = $data['discharge_date'];
            $TYPEAREA = $data['house_regist_type_id'];
            $D_UPDATE = $data['last_update'];
            
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://127.0.0.1:3020/persons",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{
                \"HOSPCODE\":\"$HOSPCODE\",
                \"CID\":\"$CID\",
                \"PID\":\"$PID\",
                \"HID\":\"$HID\",
                \"PRENAME\":\"$PRENAME\",
                 \"NAME\":\"$NAME\",
                \"LNAME\":\"$LNAME\",
                \"HN\":\"$HN\",
                 \"CID\":\"$CID\",
                \"SEX\":\"$SEX\",
                \"BIRTH\":\"$BIRTH\",
                \"MSTATUS\":\"$MSTATUS\", 
                 \"NATION\":\"$NATION\",
                 \"DISCHARGE\":\"$DISCHARGE\",
                 \"DDISCHARGE\":\"$DDISCHARGE\",
                  \"TYPEAREA\":\"$TYPEAREA\",
                \"D_UPDATE\":\"$D_UPDATE\"    
                    }",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo $response;
        }

        return $this->render('testapi');
    }

    public function actionIndex() {
        $searchModel = new MdrugitemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexupdate() {
        $searchModel = new MdrugitemsUpdate();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexupdate', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdminindex() {
        $searchModel = new MdrugitemsSearch2();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('adminindex', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDrugitemsapi() {

        //   $session = Yii::$app->session;    
        // $token = $session->get('mytoken');
        // $session->open();
        // $session->close();

        $searchModel = new MdrugitemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // $url = Yii::$app->params['webservice'];

        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJyZXN1bHQiOnsiZW1haWwiOiJzYW92YWtvbkBUb29sc2hvcy50ZXN0In0sImlhdCI6MTU5MjkyMzQ2MSwiZXhwIjoxNTkyOTQxNDYxfQ.fTsi15bCeynhqtqN4SsB9XyI5oATrNI_zHT4WP0WBqE';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://127.0.0.1:3012/drugitems",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{\r\n    \"id\":\"2\",\r\n    \"email\":\"saovakon@Toolshos.test\",\r\n    \"password\":\"##Ps1222854@\"\r\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJyZXN1bHQiOnsiZW1haWwiOiJzYW92YWtvbkBUb29sc2hvcy50ZXN0In0sImlhdCI6MTU5MjkyMzQ2MSwiZXhwIjoxNTkyOTQxNDYxfQ.fTsi15bCeynhqtqN4SsB9XyI5oATrNI_zHT4WP0WBqE",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);



        // $jsonurl = "$url/ppspecials/$b_date/$user";
        //  $json = file_get_contents($response);  
        $data = json_decode($response, true);
        // $datacount = sizeof($data['data']);
        // echo $datacount;

        foreach ($data['data'] as $key => $item) {

            $icode = $item['icode'];
            $dosageform = $item['dosageform'];
            $drugaccount = $item['drugaccount'];
            $drugcategory = $item['drugcategory'];
            $unitprice = $item['unitprice'];
            $hintcode = $item['hintcode'];
            $istatus = $item['istatus'];
            $name = $item['name'];
            $packqty = $item['packqty'];
            $strength = $item['strength'];
            $therapeutic = $item['therapeutic'];
            $therapeuticgroup = $item['therapeuticgroup'];
            $units = $item['units'];
            $oldcode = $item['oldcode'];
            $income = $item['income'];
            $no_discount = $item['no_discount'];
            $generic_name = $item['generic_name'];
            $show_child_notify = $item['show_child_notify'];
            $check_druginteraction_history = $item['check_druginteraction_history'];

            /*
              $sql = "INSERT IGNORE INTO pp_special(pp_special_id,vn,pp_special_type_id,doctor,pp_special_service_place_type_id,entry_datetime,dest_hospcode,hn)
              VALUE('{$item['pp_special_id']}','{$item['vn']}','{$item['pp_special_type_id']}','{$item['doctor']}','{$item['pp_special_service_place_type_id']}','{$item['entry_datetime']}','{$item['dest_hospcode']}','{$item['hn']}')";
             */


            $sql = "REPLACE INTO drugitems_10918(icode,dosageform,drugaccount,unitprice,drugcategory,hintcode,istatus,name,packqty,strength,therapeutic,therapeuticgroup,
units,oldcode,income,no_discount,generic_name,show_child_notify,check_druginteraction_history)
            VALUE('$icode','$dosageform','$drugaccount','$unitprice','$drugcategory','$hintcode','$istatus','$name','$packqty','$strength','$therapeutic','$therapeuticgroup',
                '$units','$oldcode','$income','$no_discount','$generic_name','$show_child_notify','$check_druginteraction_history')";
            $this->exec_hosxp_pcu($sql);


            /*
              $sql2 = "update serial
              SET serial_no = (select max(pp_special_id) FROM pp_special)
              WHERE name = 'pp_special_id'";
              $this->exec_hos($sql2); */
        }



        return $this->render('drugitemsapi');
        //echo sizeof($data['data']);
        /*
          return $this->render('index', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
          ]);
         */
    }

    public function actionApi() {
        Yii::$app->getSession()->setFlash('success', 'ประมวลผลเรียบร้อยแล้ว!! ');
        return $this->redirect(['/pcu/mdrugitems/api2']);
    }

    public function actionApi2() {

        //   $session = Yii::$app->session;    
        // $token = $session->get('mytoken');
        // $session->open();
        // $session->close();
        $searchModel = new MdrugitemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $sql = "select person_id from person where apicheck <> MD5(last_update) order by person_id asc";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $icode = $data['person_id'];

            // $dosageform = $item['dosageform'];
            // $drugaccount = $item['drugaccount'];
            // $drugcategory = $item['drugcategory'];
            // $unitprice = $item['unitprice'];
            // $hintcode = $item['hintcode'];
            // $istatus = $item['istatus'];
            // $name = $item['name'];
            // $packqty = $item['packqty'];
            // $strength = $item['strength'];
            // $therapeutic = $item['therapeutic'];
            // $therapeuticgroup = $item['therapeuticgroup'];
            // $units = $item['units'];
            //  $oldcode = $item['oldcode'];
            //  $income = $item['income'];
            // $no_discount = $item['no_discount'];
            //  $generic_name = $item['generic_name'];
            // $show_child_notify = $item['show_child_notify'];
            // $check_druginteraction_history = $item['check_druginteraction_history'];


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://127.0.0.1:3012/userdbs/test/api",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{\"data\":\"$icode\"}\r\n   ",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJyZXN1bHQiOnsiZW1haWwiOiJ1c2VyZGJAdGVzdC5jb20ifSwiaWF0IjoxNTkzMjcxNzI1LCJleHAiOjE1OTMyODk3MjV9.t1Ub6NP4XQ_KpveldQHT7x7H6KnkOZ4x-dOi49VmyBw",
                    "Content-Type: application/json"
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
//echo $response;

            /*
              $sql = "INSERT IGNORE INTO pp_special(pp_special_id,vn,pp_special_type_id,doctor,pp_special_service_place_type_id,entry_datetime,dest_hospcode,hn)
              VALUE('{$item['pp_special_id']}','{$item['vn']}','{$item['pp_special_type_id']}','{$item['doctor']}','{$item['pp_special_service_place_type_id']}','{$item['entry_datetime']}','{$item['dest_hospcode']}','{$item['hn']}')";
             */



            /*
              $sql = "REPLACE INTO drugitems_10918(icode,dosageform,drugaccount,unitprice,drugcategory,hintcode,istatus,name,packqty,strength,therapeutic,therapeuticgroup,
              units,oldcode,income,no_discount,generic_name,show_child_notify,check_druginteraction_history)
              VALUE('$icode','$dosageform','$drugaccount','$unitprice','$drugcategory','$hintcode','$istatus','$name','$packqty','$strength','$therapeutic','$therapeuticgroup',
              '$units','$oldcode','$income','$no_discount','$generic_name','$show_child_notify','$check_druginteraction_history')";
              $this->exec_center($sql);
             */

            /*
              $sql2 = "update serial
              SET serial_no = (select max(pp_special_id) FROM pp_special)
              WHERE name = 'pp_special_id'";
              $this->exec_hos($sql2); */
        }




        //  return $this->render('api2');
    }

    /**
     * Displays a single Mdrugitems model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*
      public function actionView($id) {
      return $this->render('view', [
      'model' => $this->findModel($id),
      ]);
      }
     */
    /**
     * Creates a new Mdrugitems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
      public function actionCreate()
      {
      $model = new Mdrugitems();

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->icode]);
      }

      return $this->render('create', [
      'model' => $model,
      ]);
      }

     */

    /**
     * Updates an existing Mdrugitems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionAdminupdate($id) {
        //  $this->permitRole([1,2]);
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if (\Yii::$app->request->isPost) {
                $log = new ReportLog();
                $log->hosbase_sub_id = $id;
                $log->user_id = \Yii::$app->user->identity->id;
                $log->datetime = date('Y-m-d H:i:s');
                $log->remark = 'mdrugitems';
                $log->ip = \Yii::$app->request->getUserIP();
                if ($log->save()) {
                    //MyHelper::setAlert('success','......');
                }
            }

            return $this->redirect(['adminindex']);
        } else {
            return $this->renderAjax('adminupdate', [
                        'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id) {

        $model = $this->findModel($id);
        $modelsdrug = $this->findModel2($id);
        //  $modelsdrug = MsDrugitems::findAll(['icode' => $icode]);


        if ($model->load(Yii::$app->request->post()) &&
                $modelsdrug->load(Yii::$app->request->post()) && Model::validateMultiple([$model, $modelsdrug])
        ) {

            $req = \Yii::$app->request;
            $post = $req->post();


            $icode = $post['Mdrugitems'] ['icode'];
            $name = $post['Mdrugitems'] ['name'];
            $strength = $post['Mdrugitems'] ['strength'];
            $units = $post['Mdrugitems'] ['units'];
            $unitprice = $post['Mdrugitems'] ['unitprice'];
            $dosageform = $post['Mdrugitems'] ['dosageform'];
            $criticalpriority = $post['Mdrugitems'] ['criticalpriority'];
            $drugaccount = $post['Mdrugitems'] ['drugaccount'];
            $drugcategory = $post['Mdrugitems'] ['drugcategory'];
            $drugnote = $post['Mdrugitems'] ['drugnote'];
            $hintcode = $post['Mdrugitems'] ['hintcode'];
            $istatus = $post['Mdrugitems'] ['istatus'];
            $lastupdatestdprice = $post['Mdrugitems'] ['lastupdatestdprice'];
            $lockprice = $post['Mdrugitems'] ['lockprice'];
            $lockprint = $post['Mdrugitems'] ['lockprint'];
            $maxlevel = $post['Mdrugitems'] ['maxlevel'];
            $minlevel = $post['Mdrugitems'] ['minlevel'];
            $maxunitperdose = $post['Mdrugitems'] ['maxunitperdose'];
            $packqty = $post['Mdrugitems'] ['packqty'];
            $reorderqty = $post['Mdrugitems'] ['reorderqty'];
            $stdprice = $post['Mdrugitems'] ['stdprice'];
            $stdtaken = $post['Mdrugitems'] ['stdtaken'];
            $therapeutic = $post['Mdrugitems'] ['therapeutic'];
            $therapeuticgroup = $post['Mdrugitems'] ['therapeuticgroup'];
            $default_qty = $post['Mdrugitems'] ['default_qty'];
            $gpo_code = $post['Mdrugitems'] ['gpo_code'];
            $use_right = $post['Mdrugitems'] ['use_right'];
            $i_type = $post['Mdrugitems'] ['i_type'];
            $drugusage = $post['Mdrugitems'] ['drugusage'];
            $high_cost = $post['Mdrugitems'] ['high_cost'];
            $must_paid = $post['Mdrugitems'] ['must_paid'];
            $alert_level = $post['Mdrugitems'] ['alert_level'];
            $access_level = $post['Mdrugitems'] ['access_level'];
            $sticker_short_name = $post['Mdrugitems'] ['sticker_short_name'];
            $paidst = $post['Mdrugitems'] ['paidst'];
            $antibiotic = $post['Mdrugitems'] ['antibiotic'];
            $displaycolor = $post['Mdrugitems'] ['displaycolor'];
            $empty = $post['Mdrugitems'] ['empty'];
            $empty_text = $post['Mdrugitems'] ['empty_text'];
            $unitcost = $post['Mdrugitems'] ['unitcost'];
            $gfmiscode = $post['Mdrugitems'] ['gfmiscode'];
            $ipd_price = $post['Mdrugitems'] ['ipd_price'];
            $oldcode = $post['Mdrugitems'] ['oldcode'];
            $habit_forming = $post['Mdrugitems'] ['habit_forming'];
            $did = $post['Mdrugitems'] ['did'];
            $stock_type = $post['Mdrugitems'] ['stock_type'];
            $price2 = $post['Mdrugitems'] ['price2'];
            $price3 = $post['Mdrugitems'] ['price3'];
            $ipd_price2 = $post['Mdrugitems'] ['ipd_price2'];
            $ipd_price3 = $post['Mdrugitems'] ['ipd_price3'];
            $price_lock = $post['Mdrugitems'] ['price_lock'];
            $pregnancy = $post['Mdrugitems'] ['pregnancy'];
            $pharmacology_group1 = $post['Mdrugitems'] ['pharmacology_group1'];
            $pharmacology_group2 = $post['Mdrugitems'] ['pharmacology_group2'];
            $pharmacology_group3 = $post['Mdrugitems'] ['pharmacology_group3'];
            $generic_name = $post['Mdrugitems'] ['generic_name'];
            $show_pregnancy_alert = $post['Mdrugitems'] ['show_pregnancy_alert'];
            $icode_guid = $post['Mdrugitems'] ['icode_guid'];
            $na = $post['Mdrugitems'] ['na'];
            $invcode = $post['Mdrugitems'] ['invcode'];
            $check_user_group = $post['Mdrugitems'] ['check_user_group'];
            $check_user_name = $post['Mdrugitems'] ['check_user_name'];
            $show_notify = $post['Mdrugitems'] ['show_notify'];
            $show_notify_text = $post['Mdrugitems'] ['show_notify_text'];
            $income = $post['Mdrugitems'] ['income'];
            $print_sticker_pq = $post['Mdrugitems'] ['print_sticker_pq'];
            $charge_service_opd = $post['Mdrugitems'] ['charge_service_opd'];
            $charge_service_ipd = $post['Mdrugitems'] ['charge_service_ipd'];
            $ename = $post['Mdrugitems'] ['ename'];
            $dose_type = $post['Mdrugitems'] ['dose_type'];
            $habit_forming_type = $post['Mdrugitems'] ['habit_forming_type'];
            $no_discount = $post['Mdrugitems'] ['no_discount'];
            $therapeutic_eng = $post['Mdrugitems'] ['therapeutic_eng'];
            $hintcode_eng = $post['Mdrugitems'] ['hintcode_eng'];
            $limit_drugusage = $post['Mdrugitems'] ['limit_drugusage'];
            $print_sticker_header = $post['Mdrugitems'] ['print_sticker_header'];
            $calc_idr_qty = $post['Mdrugitems'] ['calc_idr_qty'];
            $item_in_hospital = $post['Mdrugitems'] ['item_in_hospital'];
            $no_substock = $post['Mdrugitems'] ['no_substock'];
            $volume_cc = $post['Mdrugitems'] ['volume_cc'];
            $usage_code = $post['Mdrugitems'] ['usage_code'];
            $frequency_code = $post['Mdrugitems'] ['frequency_code'];
            $time_code = $post['Mdrugitems'] ['time_code'];
            $dispense_dose = $post['Mdrugitems'] ['dispense_dose'];
            $usage_unit_code = $post['Mdrugitems'] ['usage_unit_code'];
            $dose_per_units = $post['Mdrugitems'] ['dose_per_units'];
            $ipd_default_pay = $post['Mdrugitems'] ['ipd_default_pay'];
            $billcode = $post['Mdrugitems'] ['billcode'];
            $billnumber = $post['Mdrugitems'] ['billnumber'];
            $lockprint_ipd = $post['Mdrugitems'] ['lockprint_ipd'];
            $pregnancy_notify_text = $post['Mdrugitems'] ['pregnancy_notify_text'];
            $show_breast_feeding_alert = $post['Mdrugitems'] ['show_breast_feeding_alert'];
            $breast_feeding_alert_text = $post['Mdrugitems'] ['breast_feeding_alert_text'];
            $show_child_notify = $post['Mdrugitems'] ['show_child_notify'];
            $child_notify_text = $post['Mdrugitems'] ['child_notify_text'];
            $child_notify_min_age = $post['Mdrugitems'] ['child_notify_min_age'];
            $child_notify_max_age = $post['Mdrugitems'] ['child_notify_max_age'];
            $continuous = $post['Mdrugitems'] ['continuous'];
            $substitute_icode = $post['Mdrugitems'] ['substitute_icode'];
            $trade_name = $post['Mdrugitems'] ['trade_name'];
            $use_right_allow = $post['Mdrugitems'] ['use_right_allow'];
            $medication_machine_id = $post['Mdrugitems'] ['medication_machine_id'];
            $ipd_medication_machine_id = $post['Mdrugitems'] ['ipd_medication_machine_id'];
            $check_remed_qty = $post['Mdrugitems'] ['check_remed_qty'];
            $addict = $post['Mdrugitems'] ['addict'];
            $addict_type_id = $post['Mdrugitems'] ['addict_type_id'];
            $medication_machine_opd_no = $post['Mdrugitems'] ['medication_machine_opd_no'];
            $medication_machine_ipd_no = $post['Mdrugitems'] ['medication_machine_ipd_no'];
            $fp_drug = $post['Mdrugitems'] ['fp_drug'];
            $usage_code_ipd = $post['Mdrugitems'] ['usage_code_ipd'];
            $dispense_dose_ipd = $post['Mdrugitems'] ['dispense_dose_ipd'];
            $usage_unit_code_ipd = $post['Mdrugitems'] ['usage_unit_code_ipd'];
            $frequency_code_ipd = $post['Mdrugitems'] ['frequency_code_ipd'];
            $time_code_ipd = $post['Mdrugitems'] ['time_code_ipd'];
            $print_ipd_injection_sticker = $post['Mdrugitems'] ['print_ipd_injection_sticker'];
            $provis_medication_unit_code = $post['Mdrugitems'] ['provis_medication_unit_code'];
            $hos_guid = $post['Mdrugitems'] ['hos_guid'];
            $sks_product_category_id = $post['Mdrugitems'] ['sks_product_category_id'];
            $sks_clain_control_type_id = $post['Mdrugitems'] ['sks_clain_control_type_id'];
            $sks_drug_code = $post['Mdrugitems'] ['sks_drug_code'];
            $sks_dfs_code = $post['Mdrugitems'] ['sks_dfs_code'];
            $sks_dfs_text = $post['Mdrugitems'] ['sks_dfs_text'];
            $sks_reimb_price = $post['Mdrugitems'] ['sks_reimb_price'];
            $hos_guid_ext = $post['Mdrugitems'] ['hos_guid_ext'];
            $check_druginteraction_history = $post['Mdrugitems'] ['check_druginteraction_history'];
            $check_druginteraction_history_day = $post['Mdrugitems'] ['check_druginteraction_history_day'];
            $nhso_adp_type_id = $post['Mdrugitems'] ['nhso_adp_type_id'];
            $nhso_adp_code = $post['Mdrugitems'] ['nhso_adp_code'];
            $sks_claim_control_type_id = $post['Mdrugitems'] ['sks_claim_control_type_id'];
            $begin_date = $post['Mdrugitems'] ['begin_date'];
            $finish_date = $post['Mdrugitems'] ['finish_date'];
            $name_pr = $post['Mdrugitems'] ['name_pr'];
            $name_eng = $post['Mdrugitems'] ['name_eng'];
            $capacity_name = $post['Mdrugitems'] ['capacity_name'];
            $finish_reason = $post['Mdrugitems'] ['finish_reason'];
            $extra_unitcost = $post['Mdrugitems'] ['extra_unitcost'];
            $drug_control_type_id = $post['Mdrugitems'] ['drug_control_type_id'];
            $name_print = $post['Mdrugitems'] ['name_print'];
            $active_ingredient_mg = $post['Mdrugitems'] ['active_ingredient_mg'];
            $no_order_g6pd = $post['Mdrugitems'] ['no_order_g6pd'];
            $gender_check = $post['Mdrugitems'] ['gender_check'];
            $no_order_gender = $post['Mdrugitems'] ['no_order_gender'];
            $max_qty = $post['Mdrugitems'] ['max_qty'];
            $prefer_opd_usage_code = $post['Mdrugitems'] ['prefer_opd_usage_code'];
            $capacity_qty = $post['Mdrugitems'] ['capacity_qty'];
            $need_order_reason = $post['Mdrugitems'] ['need_order_reason'];
            $drugitems_due_type_id = $post['Mdrugitems'] ['drugitems_due_type_id'];
            $drugeval_head_id = $post['Mdrugitems'] ['drugeval_head_id'];
            $light_protect = $post['Mdrugitems'] ['light_protect'];
            $tpu_code_list = $post['Mdrugitems'] ['tpu_code_list'];
            $inv_map_update = $post['Mdrugitems'] ['inv_map_update'];
            $special_advice_text = $post['Mdrugitems'] ['special_advice_text'];
            $precaution_advice_text = $post['Mdrugitems'] ['precaution_advice_text'];
            $contra_advice_text = $post['Mdrugitems'] ['contra_advice_text'];
            $storage_advice_text = $post['Mdrugitems'] ['storage_advice_text'];
            $qr_code_url = $post['Mdrugitems'] ['qr_code_url'];
            $vat_percent = $post['Mdrugitems'] ['vat_percent'];
            $acc_regist = $post['Mdrugitems'] ['acc_regist'];
            $use_paidst = $post['Mdrugitems'] ['use_paidst'];
            $thai_name = $post['Mdrugitems'] ['thai_name'];
            $fwf_item_id = $post['Mdrugitems'] ['fwf_item_id'];
            $drugitems_em1_id = $post['Mdrugitems'] ['drugitems_em1_id'];
            $drugitems_em2_id = $post['Mdrugitems'] ['drugitems_em2_id'];
            $drugitems_em3_id = $post['Mdrugitems'] ['drugitems_em3_id'];
            $drugitems_em4_id = $post['Mdrugitems'] ['drugitems_em4_id'];
            $tmt_tp_code = $post['Mdrugitems'] ['tmt_tp_code'];
            $tmt_gp_code = $post['Mdrugitems'] ['tmt_gp_code'];
            $limit_pttype = $post['Mdrugitems'] ['limit_pttype'];
            $noshow_narcotic = $post['Mdrugitems'] ['noshow_narcotic'];
            $medication_machine_flag = $post['Mdrugitems'] ['medication_machine_flag'];
            $sks_price = $post['Mdrugitems'] ['sks_price'];
            $print_sticker_by_frequency = $post['Mdrugitems'] ['print_sticker_by_frequency'];
            $print_sticker_pq_ipd = $post['Mdrugitems'] ['print_sticker_pq_ipd'];
            $sub_income = $post['Mdrugitems'] ['sub_income'];
            $prefer_ipd_usage_code = $post['Mdrugitems'] ['prefer_ipd_usage_code'];
            $default_qty_ipd = $post['Mdrugitems'] ['default_qty_ipd'];
            $max_qty_ipd = $post['Mdrugitems'] ['max_qty_ipd'];
            $drugusage_ipd = $post['Mdrugitems'] ['drugusage_ipd'];
            $no_popup_ipd_reason = $post['Mdrugitems'] ['no_popup_ipd_reason'];
            $specprep = $post['Mdrugitems'] ['specprep'];
            $med_dose_calc_type_id = $post['Mdrugitems'] ['med_dose_calc_type_id'];
            $send_line_notify = $post['Mdrugitems'] ['send_line_notify'];
            $show_qrcode_trade = $post['Mdrugitems'] ['show_qrcode_trade'];
            $warn_g6pd = $post['Mdrugitems'] ['warn_g6pd'];
            $ipd_rx_freq_day = $post['Mdrugitems'] ['ipd_rx_freq_day'];
            $check_status = $post['Mdrugitems'] ['check_status'];
            $check_anti = $post['Mdrugitems'] ['check_anti'];


            $icode2 = $post['MsDrugitems'] ['icode'];
            $name2 = $post['MsDrugitems'] ['name'];
            $strength2 = $post['MsDrugitems'] ['strength'];
            $units2 = $post['MsDrugitems'] ['units'];
            $dosageform2 = $post['MsDrugitems'] ['dosageform'];
            $drugnote2 = $post['MsDrugitems'] ['drugnote'];
            $use_right2 = $post['MsDrugitems'] ['use_right'];
            $must_paid2 = $post['MsDrugitems'] ['must_paid'];
            $istatus2 = $post['MsDrugitems'] ['istatus'];
            $access_level2 = $post['MsDrugitems'] ['access_level'];
            $paidst2 = $post['MsDrugitems'] ['paidst'];
            $displaycolor2 = $post['MsDrugitems'] ['displaycolor'];
            $price_lock2 = $post['MsDrugitems'] ['price_lock'];
            //  $icode_guid2 = $post['MsDrugitems'] ['icode_guid'];
            $ename2 = $post['MsDrugitems'] ['ename'];
            $cost2 = $post['MsDrugitems'] ['cost'];
            $income2 = $post['MsDrugitems'] ['income'];
            //  $hos_guid2 = $post['MsDrugitems'] ['hos_guid'];
            //  $hos_guid_ext2 = $post['MsDrugitems'] ['hos_guid_ext'];
            $is_medication2 = $post['MsDrugitems'] ['is_medication'];
            $use_paidst2 = $post['MsDrugitems'] ['use_paidst'];
            $is_medsupply2 = $post['MsDrugitems'] ['is_medsupply'];
            $sub_income2 = $post['MsDrugitems'] ['sub_income'];
            //  $highcost = $post['MsDrugitems'] ['highcost'];
            $oldcode2 = $post['MsDrugitems'] ['oldcode'];



            $sql = "REPLACE INTO drugitems_10918 (icode,name,strength,units,unitprice,dosageform,criticalpriority,drugaccount,drugcategory,drugnote,hintcode,istatus,lastupdatestdprice,lockprice,lockprint
,maxlevel,minlevel,maxunitperdose,packqty,reorderqty,stdprice,stdtaken,therapeutic,therapeuticgroup,default_qty,gpo_code,use_right,i_type,drugusage,high_cost
,must_paid,alert_level,access_level,sticker_short_name,paidst,antibiotic,displaycolor,empty,empty_text,unitcost,gfmiscode,ipd_price,oldcode,habit_forming,did
,stock_type,price2,price3,ipd_price2,ipd_price3,price_lock,pregnancy,pharmacology_group1,pharmacology_group2,pharmacology_group3,generic_name,show_pregnancy_alert
,icode_guid,na,invcode,check_user_group,check_user_name,show_notify,show_notify_text,income,print_sticker_pq,charge_service_opd,charge_service_ipd,ename,dose_type
,habit_forming_type,no_discount,therapeutic_eng,hintcode_eng,limit_drugusage,print_sticker_header,calc_idr_qty,item_in_hospital,no_substock,volume_cc,usage_code
,frequency_code,time_code,dispense_dose,usage_unit_code,dose_per_units,ipd_default_pay,billcode,billnumber,lockprint_ipd,pregnancy_notify_text,show_breast_feeding_alert
,breast_feeding_alert_text,show_child_notify,child_notify_text,child_notify_min_age,child_notify_max_age,continuous,substitute_icode,trade_name,use_right_allow
,medication_machine_id,ipd_medication_machine_id,check_remed_qty,addict,addict_type_id,medication_machine_opd_no,medication_machine_ipd_no,fp_drug,usage_code_ipd,
dispense_dose_ipd,usage_unit_code_ipd,frequency_code_ipd,time_code_ipd,print_ipd_injection_sticker,provis_medication_unit_code,hos_guid,sks_product_category_id,
sks_clain_control_type_id,sks_drug_code,sks_dfs_code,sks_dfs_text,sks_reimb_price,hos_guid_ext,check_druginteraction_history,check_druginteraction_history_day,
nhso_adp_type_id,nhso_adp_code,sks_claim_control_type_id,begin_date,finish_date,name_pr,name_eng,capacity_name,finish_reason,extra_unitcost,drug_control_type_id,
name_print,active_ingredient_mg,no_order_g6pd,gender_check,no_order_gender,max_qty,prefer_opd_usage_code,capacity_qty,need_order_reason,drugitems_due_type_id,
drugeval_head_id,light_protect,tpu_code_list,inv_map_update,special_advice_text,precaution_advice_text,contra_advice_text,storage_advice_text,qr_code_url,vat_percent,
acc_regist,use_paidst,thai_name,fwf_item_id,drugitems_em1_id,drugitems_em2_id,drugitems_em3_id,drugitems_em4_id,tmt_tp_code,tmt_gp_code,limit_pttype,noshow_narcotic,
medication_machine_flag,sks_price,print_sticker_by_frequency,print_sticker_pq_ipd,sub_income,prefer_ipd_usage_code,default_qty_ipd,max_qty_ipd,drugusage_ipd,
no_popup_ipd_reason,specprep,med_dose_calc_type_id,send_line_notify,show_qrcode_trade,warn_g6pd,ipd_rx_freq_day,check_status,check_anti) VALUES  
                     ('$icode','$name','$strength','$units','$unitprice','$dosageform','$criticalpriority','$drugaccount','$drugcategory','$drugnote','$hintcode','$istatus','$lastupdatestdprice','$lockprice','$lockprint'
,'$maxlevel','$minlevel','$maxunitperdose','$packqty','$reorderqty','$stdprice','$stdtaken','$therapeutic','$therapeuticgroup','$default_qty','$gpo_code','$use_right','$i_type','$drugusage','$high_cost'
,'$must_paid','$alert_level','$access_level','$sticker_short_name','$paidst','$antibiotic','$displaycolor','$empty','$empty_text','$unitcost','$gfmiscode','$ipd_price','$oldcode','$habit_forming','$did'
,'$stock_type','$price2','$price3','$ipd_price2','$ipd_price3','$price_lock','$pregnancy','$pharmacology_group1','$pharmacology_group2','$pharmacology_group3','$generic_name','$show_pregnancy_alert'
,'$icode_guid','$na','$invcode','$check_user_group','$check_user_name','$show_notify','$show_notify_text','$income','$print_sticker_pq','$charge_service_opd','$charge_service_ipd','$ename','$dose_type'
,'$habit_forming_type','$no_discount','$therapeutic_eng','$hintcode_eng','$limit_drugusage','$print_sticker_header','$calc_idr_qty','$item_in_hospital','$no_substock','$volume_cc','$usage_code'
,'$frequency_code','$time_code','$dispense_dose','$usage_unit_code','$dose_per_units','$ipd_default_pay','$billcode','$billnumber','$lockprint_ipd','$pregnancy_notify_text','$show_breast_feeding_alert'
,'$breast_feeding_alert_text','$show_child_notify','$child_notify_text','$child_notify_min_age','$child_notify_max_age','$continuous','$substitute_icode','$trade_name','$use_right_allow'
,'$medication_machine_id','$ipd_medication_machine_id','$check_remed_qty','$addict','$addict_type_id','$medication_machine_opd_no','$medication_machine_ipd_no','$fp_drug','$usage_code_ipd'
,'$dispense_dose_ipd','$usage_unit_code_ipd','$frequency_code_ipd','$time_code_ipd','$print_ipd_injection_sticker','$provis_medication_unit_code','$hos_guid','$sks_product_category_id'
,'$sks_clain_control_type_id','$sks_drug_code','$sks_dfs_code','$sks_dfs_text','$sks_reimb_price','$hos_guid_ext','$check_druginteraction_history','$check_druginteraction_history_day'
,'$nhso_adp_type_id','$nhso_adp_code','$sks_claim_control_type_id','$begin_date','$finish_date','$name_pr','$name_eng','$capacity_name','$finish_reason','$extra_unitcost','$drug_control_type_id'
,'$name_print','$active_ingredient_mg','$no_order_g6pd','$gender_check','$no_order_gender','$max_qty','$prefer_opd_usage_code','$capacity_qty','$need_order_reason','$drugitems_due_type_id'
,'$drugeval_head_id','$light_protect','$tpu_code_list','$inv_map_update','$special_advice_text','$precaution_advice_text','$contra_advice_text','$storage_advice_text','$qr_code_url','$vat_percent'
,'$acc_regist','$use_paidst','$thai_name','$fwf_item_id','$drugitems_em1_id','$drugitems_em2_id','$drugitems_em3_id','$drugitems_em4_id','$tmt_tp_code','$tmt_gp_code','$limit_pttype','$noshow_narcotic'
,'$medication_machine_flag','$sks_price','$print_sticker_by_frequency','$print_sticker_pq_ipd','$sub_income','$prefer_ipd_usage_code','$default_qty_ipd','$max_qty_ipd','$drugusage_ipd'
,'$no_popup_ipd_reason','$specprep','$med_dose_calc_type_id','$send_line_notify','$show_qrcode_trade','$warn_g6pd','$ipd_rx_freq_day','$check_status','$check_anti') ";
            $this->exec_hosxp_pcu($sql);



            $sql2 = "REPLACE INTO s_drugitems (icode,name,strength,units,dosageform,drugnote,use_right,must_paid,istatus
,access_level,paidst,displaycolor,price_lock,ename,cost,income
/*,hos_guid,hos_guid_ext*/,is_medication,use_paidst
,is_medsupply,sub_income,oldcode) VALUES  
                     ('$icode2','$name2','$strength2','$units2','$dosageform2','$drugnote2','$use_right2','$must_paid2','$istatus2'
,'$access_level2','$paidst2','$displaycolor2','$price_lock2','$ename2','$cost2','$income2'
,'$is_medication2','$use_paidst2'
,'$is_medsupply2','$sub_income2','$oldcode2')";
            $this->exec_hosxp_pcu($sql2);
            $model->save();


            if (\Yii::$app->request->isPost) {

                $opd = Opdconfig::find()
                        ->one();
                $opdconfig = $opd->hospitalcode;

                $check_status = '1';
                $model = Drugitems::find()->select('icode')/* ->asArray() */
                        ->all();

                $query = Mdrugitems::find()
                        ->where(['NOT IN', 'icode', $model])
                        ->andWhere('check_status = :check_status', [':check_status' => $check_status])
                        ->count();

                $id = '1';
                $log = new ReportLog();
                $log->code_data = $icode;
                $log->user_id = \Yii::$app->user->identity->id;
                $log->datetime = date('Y-m-d H:i:s');
                $log->data_index_id = $id;
                $log->ip = \Yii::$app->request->getUserIP();
                $log->save();

                $sql = "delete from count_data_pcu where hosp_code = '$opdconfig' and data_id = '$id'";
                $this->exec_pcu_master($sql);

                $idkey = $opdconfig . $id;
                $log = new CountDataPcu();
                $log->idkey = $idkey;
                $log->count_data = $query;
                $log->data_id = $id;
                $log->datetime = date('Y-m-d H:i:s');
                $log->hosp_code = $opdconfig;
                $log->ip = \Yii::$app->request->getUserIP();
                $log->save();
            }
            return $this->redirect(['index', 'id' => $icode]);
        } else {
            return $this->renderAjax('update', [
                        'model' => $model,
                        'modelsdrug' => $modelsdrug,
            ]);
        }
    }

    public function actionUpProcess() {

        $searchModel = new MdrugitemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $sql0 = "update drugitems_10918 dm
     SET dm.check_status = '1'
    WHERE (dm.check_status = '' or dm.check_status is null)";
        $this->exec_hosxp_pcu($sql0);


        $sqld = "INSERT INTO drugitems(icode,name,strength,units,unitprice,dosageform,drugaccount,drugcategory,drugnote,hintcode,istatus,lastupdatestdprice,lockprice,lockprint
,maxlevel,minlevel,maxunitperdose,packqty,reorderqty,therapeutic,therapeuticgroup,use_right,drugusage,high_cost
,must_paid,alert_level,access_level,sticker_short_name,paidst,antibiotic,displaycolor,empty,unitcost,ipd_price,habit_forming,did
,price2,price3,ipd_price2,ipd_price3,price_lock,pregnancy,pharmacology_group1,pharmacology_group2,pharmacology_group3,generic_name,show_pregnancy_alert
,icode_guid,na,invcode,check_user_group,check_user_name,show_notify,show_notify_text,income,print_sticker_pq,charge_service_opd,charge_service_ipd,ename,dose_type
,habit_forming_type,no_discount,therapeutic_eng,hintcode_eng,limit_drugusage,print_sticker_header,calc_idr_qty,item_in_hospital,no_substock,volume_cc,usage_code
,frequency_code,time_code,dispense_dose,usage_unit_code,dose_per_units,ipd_default_pay,billcode,billnumber,lockprint_ipd,pregnancy_notify_text,show_breast_feeding_alert
,breast_feeding_alert_text,show_child_notify,child_notify_text,child_notify_min_age,child_notify_max_age,continuous,substitute_icode,trade_name,use_right_allow
,medication_machine_id,ipd_medication_machine_id,check_remed_qty,addict,addict_type_id,medication_machine_opd_no,medication_machine_ipd_no,fp_drug,usage_code_ipd,
dispense_dose_ipd,usage_unit_code_ipd,frequency_code_ipd,time_code_ipd,print_ipd_injection_sticker,provis_medication_unit_code,hos_guid,sks_product_category_id,
sks_clain_control_type_id,sks_drug_code,sks_dfs_code,sks_dfs_text,sks_reimb_price,hos_guid_ext,check_druginteraction_history,check_druginteraction_history_day,
nhso_adp_type_id,nhso_adp_code,sks_claim_control_type_id,begin_date,finish_date,name_pr,name_eng,capacity_name,finish_reason,extra_unitcost,drug_control_type_id,
name_print,active_ingredient_mg,no_order_g6pd,gender_check,no_order_gender,max_qty,prefer_opd_usage_code,capacity_qty,need_order_reason,drugitems_due_type_id,
drugeval_head_id,light_protect,tpu_code_list,inv_map_update,special_advice_text,precaution_advice_text,contra_advice_text,storage_advice_text,qr_code_url,vat_percent,
acc_regist,use_paidst,thai_name,fwf_item_id,drugitems_em1_id,drugitems_em2_id,drugitems_em3_id,drugitems_em4_id,tmt_tp_code,tmt_gp_code,limit_pttype,noshow_narcotic,
medication_machine_flag,sks_price,print_sticker_by_frequency,print_sticker_pq_ipd,sub_income,prefer_ipd_usage_code,default_qty_ipd,max_qty_ipd,drugusage_ipd,
no_popup_ipd_reason,specprep,med_dose_calc_type_id,send_line_notify,show_qrcode_trade,warn_g6pd,ipd_rx_freq_day)

select icode,name,strength,units,unitprice,dosageform,drugaccount,drugcategory,drugnote,hintcode,istatus,lastupdatestdprice,lockprice,lockprint
,maxlevel,minlevel,maxunitperdose,packqty,reorderqty,therapeutic,therapeuticgroup,use_right,drugusage,high_cost
,must_paid,alert_level,access_level,sticker_short_name,paidst,antibiotic,displaycolor,empty,unitcost,ipd_price,habit_forming,did
,price2,price3,ipd_price2,ipd_price3,price_lock,pregnancy,pharmacology_group1,pharmacology_group2,pharmacology_group3,generic_name,show_pregnancy_alert
,icode_guid,na,invcode,check_user_group,check_user_name,show_notify,show_notify_text,income,print_sticker_pq,charge_service_opd,charge_service_ipd,ename,dose_type
,habit_forming_type,no_discount,therapeutic_eng,hintcode_eng,limit_drugusage,print_sticker_header,calc_idr_qty,item_in_hospital,no_substock,volume_cc,usage_code
,frequency_code,time_code,dispense_dose,usage_unit_code,dose_per_units,ipd_default_pay,billcode,billnumber,lockprint_ipd,pregnancy_notify_text,show_breast_feeding_alert
,breast_feeding_alert_text,show_child_notify,child_notify_text,child_notify_min_age,child_notify_max_age,continuous,substitute_icode,trade_name,use_right_allow
,medication_machine_id,ipd_medication_machine_id,check_remed_qty,addict,addict_type_id,medication_machine_opd_no,medication_machine_ipd_no,fp_drug,usage_code_ipd,
dispense_dose_ipd,usage_unit_code_ipd,frequency_code_ipd,time_code_ipd,print_ipd_injection_sticker,provis_medication_unit_code,hos_guid,sks_product_category_id,
sks_clain_control_type_id,sks_drug_code,sks_dfs_code,sks_dfs_text,sks_reimb_price,hos_guid_ext,check_druginteraction_history,check_druginteraction_history_day,
nhso_adp_type_id,nhso_adp_code,sks_claim_control_type_id,begin_date,finish_date,name_pr,name_eng,capacity_name,finish_reason,extra_unitcost,drug_control_type_id,
name_print,active_ingredient_mg,no_order_g6pd,gender_check,no_order_gender,max_qty,prefer_opd_usage_code,capacity_qty,need_order_reason,drugitems_due_type_id,
drugeval_head_id,light_protect,tpu_code_list,inv_map_update,special_advice_text,precaution_advice_text,contra_advice_text,storage_advice_text,qr_code_url,vat_percent,
acc_regist,use_paidst,thai_name,fwf_item_id,drugitems_em1_id,drugitems_em2_id,drugitems_em3_id,drugitems_em4_id,tmt_tp_code,tmt_gp_code,limit_pttype,noshow_narcotic,
medication_machine_flag,sks_price,print_sticker_by_frequency,print_sticker_pq_ipd,sub_income,prefer_ipd_usage_code,default_qty_ipd,max_qty_ipd,drugusage_ipd,
no_popup_ipd_reason,specprep,med_dose_calc_type_id,send_line_notify,show_qrcode_trade,warn_g6pd,ipd_rx_freq_day
 
FROM drugitems_10918 WHERE check_status = '1' 
AND icode not in(select icode FROM drugitems);
";
        $this->exec_hosxp_pcu($sqld);

        $sql = "update drugitems d 
,drugitems_10918 dm
SET d.name = dm.name, d.drugaccount = dm.drugaccount, d.unitcost = dm.unitcost ,d.unitprice = dm.unitprice, d.tpu_code_list = dm.tpu_code_list
WHERE d.icode = dm.icode AND d.did = dm.did";
        $this->exec_hosxp_pcu($sql);

        $sql1 = "insert into s_drugitems(
icode,`name`,strength,units,dosageform,drugnote,use_right
,must_paid,istatus,access_level,paidst,displaycolor,price_lock
,ename,cost,income,is_medication,use_paidst
,is_medsupply,sub_income,/*highcost,*/oldcode,displaycolor_focus
)

select icode,`name`,strength,units,dosageform,drugnote,use_right
,must_paid,istatus,access_level,paidst,displaycolor,price_lock
,concat(`name`,' ',strength,' ',units) as ename,unitcost,income,'Y' as is_medication,use_paidst
,'N' as is_medsupply,sub_income,/*high_cost,*/oldcode,displaycolor_focus
from drugitems  where icode not in( select icode from s_drugitems)";
        $this->exec_hosxp_pcu($sql1);

        $sql2 = "update s_drugitems sd,drugitems d
set sd.istatus = d.istatus , sd.name = d.name 
WHERE sd.icode = d.icode";
        $this->exec_hosxp_pcu($sql2);
        /*
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
         */

        Yii::$app->getSession()->setFlash('success', 'ประมวลผลเรียบร้อยแล้ว!! ');
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdateall() {

        $model = Mdrugitems::find()
                ->all();
        $modelsdrug = MsDrugitems::find()
                ->all();
        //  $modelsdrug = MsDrugitems::findAll(['icode' => $icode]);


        if ($model->load(Yii::$app->request->post()) &&
                $modelsdrug->load(Yii::$app->request->post()) && Model::validateMultiple([$model, $modelsdrug])
        ) {

            $req = \Yii::$app->request;
            $post = $req->post();


            $icode = $post['Mdrugitems'] ['icode'];
            $name = $post['Mdrugitems'] ['name'];
            $strength = $post['Mdrugitems'] ['strength'];
            $units = $post['Mdrugitems'] ['units'];
            $unitprice = $post['Mdrugitems'] ['unitprice'];
            $dosageform = $post['Mdrugitems'] ['dosageform'];
            $criticalpriority = $post['Mdrugitems'] ['criticalpriority'];
            $drugaccount = $post['Mdrugitems'] ['drugaccount'];
            $drugcategory = $post['Mdrugitems'] ['drugcategory'];
            $drugnote = $post['Mdrugitems'] ['drugnote'];
            $hintcode = $post['Mdrugitems'] ['hintcode'];
            $istatus = $post['Mdrugitems'] ['istatus'];
            $lastupdatestdprice = $post['Mdrugitems'] ['lastupdatestdprice'];
            $lockprice = $post['Mdrugitems'] ['lockprice'];
            $lockprint = $post['Mdrugitems'] ['lockprint'];
            $maxlevel = $post['Mdrugitems'] ['maxlevel'];
            $minlevel = $post['Mdrugitems'] ['minlevel'];
            $maxunitperdose = $post['Mdrugitems'] ['maxunitperdose'];
            $packqty = $post['Mdrugitems'] ['packqty'];
            $reorderqty = $post['Mdrugitems'] ['reorderqty'];
            $stdprice = $post['Mdrugitems'] ['stdprice'];
            $stdtaken = $post['Mdrugitems'] ['stdtaken'];
            $therapeutic = $post['Mdrugitems'] ['therapeutic'];
            $therapeuticgroup = $post['Mdrugitems'] ['therapeuticgroup'];
            $default_qty = $post['Mdrugitems'] ['default_qty'];
            $gpo_code = $post['Mdrugitems'] ['gpo_code'];
            $use_right = $post['Mdrugitems'] ['use_right'];
            $i_type = $post['Mdrugitems'] ['i_type'];
            $drugusage = $post['Mdrugitems'] ['drugusage'];
            $high_cost = $post['Mdrugitems'] ['high_cost'];
            $must_paid = $post['Mdrugitems'] ['must_paid'];
            $alert_level = $post['Mdrugitems'] ['alert_level'];
            $access_level = $post['Mdrugitems'] ['access_level'];
            $sticker_short_name = $post['Mdrugitems'] ['sticker_short_name'];
            $paidst = $post['Mdrugitems'] ['paidst'];
            $antibiotic = $post['Mdrugitems'] ['antibiotic'];
            $displaycolor = $post['Mdrugitems'] ['displaycolor'];
            $empty = $post['Mdrugitems'] ['empty'];
            $empty_text = $post['Mdrugitems'] ['empty_text'];
            $unitcost = $post['Mdrugitems'] ['unitcost'];
            $gfmiscode = $post['Mdrugitems'] ['gfmiscode'];
            $ipd_price = $post['Mdrugitems'] ['ipd_price'];
            $oldcode = $post['Mdrugitems'] ['oldcode'];
            $habit_forming = $post['Mdrugitems'] ['habit_forming'];
            $did = $post['Mdrugitems'] ['did'];
            $stock_type = $post['Mdrugitems'] ['stock_type'];
            $price2 = $post['Mdrugitems'] ['price2'];
            $price3 = $post['Mdrugitems'] ['price3'];
            $ipd_price2 = $post['Mdrugitems'] ['ipd_price2'];
            $ipd_price3 = $post['Mdrugitems'] ['ipd_price3'];
            $price_lock = $post['Mdrugitems'] ['price_lock'];
            $pregnancy = $post['Mdrugitems'] ['pregnancy'];
            $pharmacology_group1 = $post['Mdrugitems'] ['pharmacology_group1'];
            $pharmacology_group2 = $post['Mdrugitems'] ['pharmacology_group2'];
            $pharmacology_group3 = $post['Mdrugitems'] ['pharmacology_group3'];
            $generic_name = $post['Mdrugitems'] ['generic_name'];
            $show_pregnancy_alert = $post['Mdrugitems'] ['show_pregnancy_alert'];
            $icode_guid = $post['Mdrugitems'] ['icode_guid'];
            $na = $post['Mdrugitems'] ['na'];
            $invcode = $post['Mdrugitems'] ['invcode'];
            $check_user_group = $post['Mdrugitems'] ['check_user_group'];
            $check_user_name = $post['Mdrugitems'] ['check_user_name'];
            $show_notify = $post['Mdrugitems'] ['show_notify'];
            $show_notify_text = $post['Mdrugitems'] ['show_notify_text'];
            $income = $post['Mdrugitems'] ['income'];
            $print_sticker_pq = $post['Mdrugitems'] ['print_sticker_pq'];
            $charge_service_opd = $post['Mdrugitems'] ['charge_service_opd'];
            $charge_service_ipd = $post['Mdrugitems'] ['charge_service_ipd'];
            $ename = $post['Mdrugitems'] ['ename'];
            $dose_type = $post['Mdrugitems'] ['dose_type'];
            $habit_forming_type = $post['Mdrugitems'] ['habit_forming_type'];
            $no_discount = $post['Mdrugitems'] ['no_discount'];
            $therapeutic_eng = $post['Mdrugitems'] ['therapeutic_eng'];
            $hintcode_eng = $post['Mdrugitems'] ['hintcode_eng'];
            $limit_drugusage = $post['Mdrugitems'] ['limit_drugusage'];
            $print_sticker_header = $post['Mdrugitems'] ['print_sticker_header'];
            $calc_idr_qty = $post['Mdrugitems'] ['calc_idr_qty'];
            $item_in_hospital = $post['Mdrugitems'] ['item_in_hospital'];
            $no_substock = $post['Mdrugitems'] ['no_substock'];
            $volume_cc = $post['Mdrugitems'] ['volume_cc'];
            $usage_code = $post['Mdrugitems'] ['usage_code'];
            $frequency_code = $post['Mdrugitems'] ['frequency_code'];
            $time_code = $post['Mdrugitems'] ['time_code'];
            $dispense_dose = $post['Mdrugitems'] ['dispense_dose'];
            $usage_unit_code = $post['Mdrugitems'] ['usage_unit_code'];
            $dose_per_units = $post['Mdrugitems'] ['dose_per_units'];
            $ipd_default_pay = $post['Mdrugitems'] ['ipd_default_pay'];
            $billcode = $post['Mdrugitems'] ['billcode'];
            $billnumber = $post['Mdrugitems'] ['billnumber'];
            $lockprint_ipd = $post['Mdrugitems'] ['lockprint_ipd'];
            $pregnancy_notify_text = $post['Mdrugitems'] ['pregnancy_notify_text'];
            $show_breast_feeding_alert = $post['Mdrugitems'] ['show_breast_feeding_alert'];
            $breast_feeding_alert_text = $post['Mdrugitems'] ['breast_feeding_alert_text'];
            $show_child_notify = $post['Mdrugitems'] ['show_child_notify'];
            $child_notify_text = $post['Mdrugitems'] ['child_notify_text'];
            $child_notify_min_age = $post['Mdrugitems'] ['child_notify_min_age'];
            $child_notify_max_age = $post['Mdrugitems'] ['child_notify_max_age'];
            $continuous = $post['Mdrugitems'] ['continuous'];
            $substitute_icode = $post['Mdrugitems'] ['substitute_icode'];
            $trade_name = $post['Mdrugitems'] ['trade_name'];
            $use_right_allow = $post['Mdrugitems'] ['use_right_allow'];
            $medication_machine_id = $post['Mdrugitems'] ['medication_machine_id'];
            $ipd_medication_machine_id = $post['Mdrugitems'] ['ipd_medication_machine_id'];
            $check_remed_qty = $post['Mdrugitems'] ['check_remed_qty'];
            $addict = $post['Mdrugitems'] ['addict'];
            $addict_type_id = $post['Mdrugitems'] ['addict_type_id'];
            $medication_machine_opd_no = $post['Mdrugitems'] ['medication_machine_opd_no'];
            $medication_machine_ipd_no = $post['Mdrugitems'] ['medication_machine_ipd_no'];
            $fp_drug = $post['Mdrugitems'] ['fp_drug'];
            $usage_code_ipd = $post['Mdrugitems'] ['usage_code_ipd'];
            $dispense_dose_ipd = $post['Mdrugitems'] ['dispense_dose_ipd'];
            $usage_unit_code_ipd = $post['Mdrugitems'] ['usage_unit_code_ipd'];
            $frequency_code_ipd = $post['Mdrugitems'] ['frequency_code_ipd'];
            $time_code_ipd = $post['Mdrugitems'] ['time_code_ipd'];
            $print_ipd_injection_sticker = $post['Mdrugitems'] ['print_ipd_injection_sticker'];
            $provis_medication_unit_code = $post['Mdrugitems'] ['provis_medication_unit_code'];
            $hos_guid = $post['Mdrugitems'] ['hos_guid'];
            $sks_product_category_id = $post['Mdrugitems'] ['sks_product_category_id'];
            $sks_clain_control_type_id = $post['Mdrugitems'] ['sks_clain_control_type_id'];
            $sks_drug_code = $post['Mdrugitems'] ['sks_drug_code'];
            $sks_dfs_code = $post['Mdrugitems'] ['sks_dfs_code'];
            $sks_dfs_text = $post['Mdrugitems'] ['sks_dfs_text'];
            $sks_reimb_price = $post['Mdrugitems'] ['sks_reimb_price'];
            $hos_guid_ext = $post['Mdrugitems'] ['hos_guid_ext'];
            $check_druginteraction_history = $post['Mdrugitems'] ['check_druginteraction_history'];
            $check_druginteraction_history_day = $post['Mdrugitems'] ['check_druginteraction_history_day'];
            $nhso_adp_type_id = $post['Mdrugitems'] ['nhso_adp_type_id'];
            $nhso_adp_code = $post['Mdrugitems'] ['nhso_adp_code'];
            $sks_claim_control_type_id = $post['Mdrugitems'] ['sks_claim_control_type_id'];
            $begin_date = $post['Mdrugitems'] ['begin_date'];
            $finish_date = $post['Mdrugitems'] ['finish_date'];
            $name_pr = $post['Mdrugitems'] ['name_pr'];
            $name_eng = $post['Mdrugitems'] ['name_eng'];
            $capacity_name = $post['Mdrugitems'] ['capacity_name'];
            $finish_reason = $post['Mdrugitems'] ['finish_reason'];
            $extra_unitcost = $post['Mdrugitems'] ['extra_unitcost'];
            $drug_control_type_id = $post['Mdrugitems'] ['drug_control_type_id'];
            $name_print = $post['Mdrugitems'] ['name_print'];
            $active_ingredient_mg = $post['Mdrugitems'] ['active_ingredient_mg'];
            $no_order_g6pd = $post['Mdrugitems'] ['no_order_g6pd'];
            $gender_check = $post['Mdrugitems'] ['gender_check'];
            $no_order_gender = $post['Mdrugitems'] ['no_order_gender'];
            $max_qty = $post['Mdrugitems'] ['max_qty'];
            $prefer_opd_usage_code = $post['Mdrugitems'] ['prefer_opd_usage_code'];
            $capacity_qty = $post['Mdrugitems'] ['capacity_qty'];
            $need_order_reason = $post['Mdrugitems'] ['need_order_reason'];
            $drugitems_due_type_id = $post['Mdrugitems'] ['drugitems_due_type_id'];
            $drugeval_head_id = $post['Mdrugitems'] ['drugeval_head_id'];
            $light_protect = $post['Mdrugitems'] ['light_protect'];
            $tpu_code_list = $post['Mdrugitems'] ['tpu_code_list'];
            $inv_map_update = $post['Mdrugitems'] ['inv_map_update'];
            $special_advice_text = $post['Mdrugitems'] ['special_advice_text'];
            $precaution_advice_text = $post['Mdrugitems'] ['precaution_advice_text'];
            $contra_advice_text = $post['Mdrugitems'] ['contra_advice_text'];
            $storage_advice_text = $post['Mdrugitems'] ['storage_advice_text'];
            $qr_code_url = $post['Mdrugitems'] ['qr_code_url'];
            $vat_percent = $post['Mdrugitems'] ['vat_percent'];
            $acc_regist = $post['Mdrugitems'] ['acc_regist'];
            $use_paidst = $post['Mdrugitems'] ['use_paidst'];
            $thai_name = $post['Mdrugitems'] ['thai_name'];
            $fwf_item_id = $post['Mdrugitems'] ['fwf_item_id'];
            $drugitems_em1_id = $post['Mdrugitems'] ['drugitems_em1_id'];
            $drugitems_em2_id = $post['Mdrugitems'] ['drugitems_em2_id'];
            $drugitems_em3_id = $post['Mdrugitems'] ['drugitems_em3_id'];
            $drugitems_em4_id = $post['Mdrugitems'] ['drugitems_em4_id'];
            $tmt_tp_code = $post['Mdrugitems'] ['tmt_tp_code'];
            $tmt_gp_code = $post['Mdrugitems'] ['tmt_gp_code'];
            $limit_pttype = $post['Mdrugitems'] ['limit_pttype'];
            $noshow_narcotic = $post['Mdrugitems'] ['noshow_narcotic'];
            $medication_machine_flag = $post['Mdrugitems'] ['medication_machine_flag'];
            $sks_price = $post['Mdrugitems'] ['sks_price'];
            $print_sticker_by_frequency = $post['Mdrugitems'] ['print_sticker_by_frequency'];
            $print_sticker_pq_ipd = $post['Mdrugitems'] ['print_sticker_pq_ipd'];
            $sub_income = $post['Mdrugitems'] ['sub_income'];
            $prefer_ipd_usage_code = $post['Mdrugitems'] ['prefer_ipd_usage_code'];
            $default_qty_ipd = $post['Mdrugitems'] ['default_qty_ipd'];
            $max_qty_ipd = $post['Mdrugitems'] ['max_qty_ipd'];
            $drugusage_ipd = $post['Mdrugitems'] ['drugusage_ipd'];
            $no_popup_ipd_reason = $post['Mdrugitems'] ['no_popup_ipd_reason'];
            $specprep = $post['Mdrugitems'] ['specprep'];
            $med_dose_calc_type_id = $post['Mdrugitems'] ['med_dose_calc_type_id'];
            $send_line_notify = $post['Mdrugitems'] ['send_line_notify'];
            $show_qrcode_trade = $post['Mdrugitems'] ['show_qrcode_trade'];
            $warn_g6pd = $post['Mdrugitems'] ['warn_g6pd'];
            $ipd_rx_freq_day = $post['Mdrugitems'] ['ipd_rx_freq_day'];


            $icode2 = $post['MsDrugitems'] ['icode'];
            $name2 = $post['MsDrugitems'] ['name'];
            $strength2 = $post['MsDrugitems'] ['strength'];
            $units2 = $post['MsDrugitems'] ['units'];
            $dosageform2 = $post['MsDrugitems'] ['dosageform'];
            $drugnote2 = $post['MsDrugitems'] ['drugnote'];
            $use_right2 = $post['MsDrugitems'] ['use_right'];
            $must_paid2 = $post['MsDrugitems'] ['must_paid'];
            $istatus2 = $post['MsDrugitems'] ['istatus'];
            $access_level2 = $post['MsDrugitems'] ['access_level'];
            $paidst2 = $post['MsDrugitems'] ['paidst'];
            $displaycolor2 = $post['MsDrugitems'] ['displaycolor'];
            $price_lock2 = $post['MsDrugitems'] ['price_lock'];
            $icode_guid2 = $post['MsDrugitems'] ['icode_guid'];
            $ename2 = $post['MsDrugitems'] ['ename'];
            $cost2 = $post['MsDrugitems'] ['cost'];
            $income2 = $post['MsDrugitems'] ['income'];
            $hos_guid2 = $post['MsDrugitems'] ['hos_guid'];
            $hos_guid_ext2 = $post['MsDrugitems'] ['hos_guid_ext'];
            $is_medication2 = $post['MsDrugitems'] ['is_medication'];
            $use_paidst2 = $post['MsDrugitems'] ['use_paidst'];
            $is_medsupply2 = $post['MsDrugitems'] ['is_medsupply'];
            $sub_income2 = $post['MsDrugitems'] ['sub_income'];
            //  $highcost = $post['MsDrugitems'] ['highcost'];
            $oldcode2 = $post['MsDrugitems'] ['oldcode'];


            $sql = "REPLACE INTO drugitems (icode,name,strength,units,unitprice,dosageform,criticalpriority,drugaccount,drugcategory,drugnote,hintcode,istatus,lastupdatestdprice,lockprice,lockprint
,maxlevel,minlevel,maxunitperdose,packqty,reorderqty,stdprice,stdtaken,therapeutic,therapeuticgroup,default_qty,gpo_code,use_right,i_type,drugusage,high_cost
,must_paid,alert_level,access_level,sticker_short_name,paidst,antibiotic,displaycolor,empty,empty_text,unitcost,gfmiscode,ipd_price,oldcode,habit_forming,did
,stock_type,price2,price3,ipd_price2,ipd_price3,price_lock,pregnancy,pharmacology_group1,pharmacology_group2,pharmacology_group3,generic_name,show_pregnancy_alert
,icode_guid,na,invcode,check_user_group,check_user_name,show_notify,show_notify_text,income,print_sticker_pq,charge_service_opd,charge_service_ipd,ename,dose_type
,habit_forming_type,no_discount,therapeutic_eng,hintcode_eng,limit_drugusage,print_sticker_header,calc_idr_qty,item_in_hospital,no_substock,volume_cc,usage_code
,frequency_code,time_code,dispense_dose,usage_unit_code,dose_per_units,ipd_default_pay,billcode,billnumber,lockprint_ipd,pregnancy_notify_text,show_breast_feeding_alert
,breast_feeding_alert_text,show_child_notify,child_notify_text,child_notify_min_age,child_notify_max_age,continuous,substitute_icode,trade_name,use_right_allow
,medication_machine_id,ipd_medication_machine_id,check_remed_qty,addict,addict_type_id,medication_machine_opd_no,medication_machine_ipd_no,fp_drug,usage_code_ipd,
dispense_dose_ipd,usage_unit_code_ipd,frequency_code_ipd,time_code_ipd,print_ipd_injection_sticker,provis_medication_unit_code,hos_guid,sks_product_category_id,
sks_clain_control_type_id,sks_drug_code,sks_dfs_code,sks_dfs_text,sks_reimb_price,hos_guid_ext,check_druginteraction_history,check_druginteraction_history_day,
nhso_adp_type_id,nhso_adp_code,sks_claim_control_type_id,begin_date,finish_date,name_pr,name_eng,capacity_name,finish_reason,extra_unitcost,drug_control_type_id,
name_print,active_ingredient_mg,no_order_g6pd,gender_check,no_order_gender,max_qty,prefer_opd_usage_code,capacity_qty,need_order_reason,drugitems_due_type_id,
drugeval_head_id,light_protect,tpu_code_list,inv_map_update,special_advice_text,precaution_advice_text,contra_advice_text,storage_advice_text,qr_code_url,vat_percent,
acc_regist,use_paidst,thai_name,fwf_item_id,drugitems_em1_id,drugitems_em2_id,drugitems_em3_id,drugitems_em4_id,tmt_tp_code,tmt_gp_code,limit_pttype,noshow_narcotic,
medication_machine_flag,sks_price,print_sticker_by_frequency,print_sticker_pq_ipd,sub_income,prefer_ipd_usage_code,default_qty_ipd,max_qty_ipd,drugusage_ipd,
no_popup_ipd_reason,specprep,med_dose_calc_type_id,send_line_notify,show_qrcode_trade,warn_g6pd,ipd_rx_freq_day) VALUES  
                     ('$icode','$name','$strength','$units','$unitprice','$dosageform','$criticalpriority','$drugaccount','$drugcategory','$drugnote','$hintcode','$istatus','$lastupdatestdprice','$lockprice','$lockprint'
,'$maxlevel','$minlevel','$maxunitperdose','$packqty','$reorderqty','$stdprice','$stdtaken','$therapeutic','$therapeuticgroup','$default_qty','$gpo_code','$use_right','$i_type','$drugusage','$high_cost'
,'$must_paid','$alert_level','$access_level','$sticker_short_name','$paidst','$antibiotic','$displaycolor','$empty','$empty_text','$unitcost','$gfmiscode','$ipd_price','$oldcode','$habit_forming','$did'
,'$stock_type','$price2','$price3','$ipd_price2','$ipd_price3','$price_lock','$pregnancy','$pharmacology_group1','$pharmacology_group2','$pharmacology_group3','$generic_name','$show_pregnancy_alert'
,'$icode_guid','$na','$invcode','$check_user_group','$check_user_name','$show_notify','$show_notify_text','$income','$print_sticker_pq','$charge_service_opd','$charge_service_ipd','$ename','$dose_type'
,'$habit_forming_type','$no_discount','$therapeutic_eng','$hintcode_eng','$limit_drugusage','$print_sticker_header','$calc_idr_qty','$item_in_hospital','$no_substock','$volume_cc','$usage_code'
,'$frequency_code','$time_code','$dispense_dose','$usage_unit_code','$dose_per_units','$ipd_default_pay','$billcode','$billnumber','$lockprint_ipd','$pregnancy_notify_text','$show_breast_feeding_alert'
,'$breast_feeding_alert_text','$show_child_notify','$child_notify_text','$child_notify_min_age','$child_notify_max_age','$continuous','$substitute_icode','$trade_name','$use_right_allow'
,'$medication_machine_id','$ipd_medication_machine_id','$check_remed_qty','$addict','$addict_type_id','$medication_machine_opd_no','$medication_machine_ipd_no','$fp_drug','$usage_code_ipd'
,'$dispense_dose_ipd','$usage_unit_code_ipd','$frequency_code_ipd','$time_code_ipd','$print_ipd_injection_sticker','$provis_medication_unit_code','$hos_guid','$sks_product_category_id'
,'$sks_clain_control_type_id','$sks_drug_code','$sks_dfs_code','$sks_dfs_text','$sks_reimb_price','$hos_guid_ext','$check_druginteraction_history','$check_druginteraction_history_day'
,'$nhso_adp_type_id','$nhso_adp_code','$sks_claim_control_type_id','$begin_date','$finish_date','$name_pr','$name_eng','$capacity_name','$finish_reason','$extra_unitcost','$drug_control_type_id'
,'$name_print','$active_ingredient_mg','$no_order_g6pd','$gender_check','$no_order_gender','$max_qty','$prefer_opd_usage_code','$capacity_qty','$need_order_reason','$drugitems_due_type_id'
,'$drugeval_head_id','$light_protect','$tpu_code_list','$inv_map_update','$special_advice_text','$precaution_advice_text','$contra_advice_text','$storage_advice_text','$qr_code_url','$vat_percent'
,'$acc_regist','$use_paidst','$thai_name','$fwf_item_id','$drugitems_em1_id','$drugitems_em2_id','$drugitems_em3_id','$drugitems_em4_id','$tmt_tp_code','$tmt_gp_code','$limit_pttype','$noshow_narcotic'
,'$medication_machine_flag','$sks_price','$print_sticker_by_frequency','$print_sticker_pq_ipd','$sub_income','$prefer_ipd_usage_code','$default_qty_ipd','$max_qty_ipd','$drugusage_ipd'
,'$no_popup_ipd_reason','$specprep','$med_dose_calc_type_id','$send_line_notify','$show_qrcode_trade','$warn_g6pd','$ipd_rx_freq_day') ";
            $this->exec_hosxp_pcu($sql);



            $sql2 = "REPLACE INTO s_drugitems (icode,name,strength,units,dosageform,drugnote,use_right,must_paid,istatus
,access_level,paidst,displaycolor,price_lock,icode_guid,ename,cost,income
,hos_guid,hos_guid_ext,is_medication,use_paidst
,is_medsupply,sub_income,oldcode) VALUES  
                     ('$icode2','$name2','$strength2','$units2','$dosageform2','$drugnote2','$use_right2','$must_paid2','$istatus2'
,'$access_level2','$paidst2','$displaycolor2','$price_lock2','$icode_guid2','$ename2','$cost2','$income2'
,'$hos_guid2','$hos_guid_ext2','$is_medication2','$use_paidst2'
,'$is_medsupply2','$sub_income2','$oldcode2')";
            $this->exec_hosxp_pcu($sql2);
            $model->save();
            // return $this->redirect(['index', 'id' => $icode]);
        }
    }

    /**
     * Deletes an existing Mdrugitems model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*
      public function actionDelete($id)
      {
      $this->findModel($id)->delete();

      return $this->redirect(['index']);
      }
     */

    /**
     * Finds the Mdrugitems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Mdrugitems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionWsperson() {


        // $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJyZXN1bHQiOnsiZW1haWwiOiJzYW92YWtvbkBUb29sc2hvcy50ZXN0In0sImlhdCI6MTU5MjkyMzQ2MSwiZXhwIjoxNTkyOTQxNDYxfQ.fTsi15bCeynhqtqN4SsB9XyI5oATrNI_zHT4WP0WBqE';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://127.0.0.1:3012/drugitems",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{\r\n    \"id\":\"2\",\r\n    \"email\":\"saovakon@Toolshos.test\",\r\n    \"password\":\"##Ps1222854@\"\r\n}",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJyZXN1bHQiOnsiZW1haWwiOiJzYW92YWtvbkBUb29sc2hvcy50ZXN0In0sImlhdCI6MTU5MjkyMzQ2MSwiZXhwIjoxNTkyOTQxNDYxfQ.fTsi15bCeynhqtqN4SsB9XyI5oATrNI_zHT4WP0WBqE",
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);


        $data = json_decode($response, true);

        foreach ($data['data'] as $key => $item) {

            $icode = $item['icode'];
            $dosageform = $item['dosageform'];
            $drugaccount = $item['drugaccount'];
            $drugcategory = $item['drugcategory'];
            $unitprice = $item['unitprice'];
            $hintcode = $item['hintcode'];
            $istatus = $item['istatus'];
            $name = $item['name'];
            $packqty = $item['packqty'];
            $strength = $item['strength'];
            $therapeutic = $item['therapeutic'];
            $therapeuticgroup = $item['therapeuticgroup'];
            $units = $item['units'];
            $oldcode = $item['oldcode'];
            $income = $item['income'];
            $no_discount = $item['no_discount'];
            $generic_name = $item['generic_name'];
            $show_child_notify = $item['show_child_notify'];
            $check_druginteraction_history = $item['check_druginteraction_history'];



            $sql = "REPLACE INTO drugitems_10918(icode,dosageform,drugaccount,unitprice,drugcategory,hintcode,istatus,name,packqty,strength,therapeutic,therapeuticgroup,
units,oldcode,income,no_discount,generic_name,show_child_notify,check_druginteraction_history)
            VALUE('$icode','$dosageform','$drugaccount','$unitprice','$drugcategory','$hintcode','$istatus','$name','$packqty','$strength','$therapeutic','$therapeuticgroup',
                '$units','$oldcode','$income','$no_discount','$generic_name','$show_child_notify','$check_druginteraction_history')";
            $this->exec_hosxp_pcu($sql);
        }



        return $this->render('wsperson');
    }

    protected function findModel($id) {
        if (($model = Mdrugitems::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModel2($id) {
        if (($model = MsDrugitems::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
