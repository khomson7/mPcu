<?php

namespace app\modules\pcu\controllers;

use app\config\components\AppController;
use app\modules\pcu\models\Opdconfig;
use app\modules\pcu\models\ReportLog;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `pcu` module
 */
class DefaultController extends AppController
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
        
                $ver = file_get_contents(Yii::getAlias('../version/version.txt'));
      //  $ver = explode(',', $ver);
       // echo $ver;
                 $opd = Opdconfig::find()
            ->one();
        $opdconfig = $opd->hospitalcode;

        $sql = "
               update chospital_amp set version = '$ver' where hoscode = $opdconfig
                ";
        $this->exec_master($sql);


        $basedata_id = '8';

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

    public function actionReportOpdAllergy()
    {

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

        $id = '24';

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

        $sql = "select concat(pt.pname,pt.fname,' ',pt.lname) as ptname,t.* FROM
(SELECT o.hn,o.agent,o.note,o.report_date from opd_allergy o
WHERE patient_cid in(select patient_cid  from opd_allergy_10918)
)t
INNER JOIN patient pt on pt.hn  =  t.hn
ORDER BY t.report_date DESC
";
        $Rawdata = \Yii::$app->db2->createCommand($sql)->queryAll();
        $data = new \yii\data\ArrayDataProvider([
            'allModels' => $Rawdata,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('report-opd-allergy', [
            'data' => $data,
            'base_data' => $base_data,
            // 'date1' => $date1,
            // 'date2' => $date2,
        ]);
    }

    public function actionHosSmDr()
    {

        $sql = "CREATE TABLE IF NOT EXISTS hos_smdr (
  hos_guid varchar(38) CHARACTER SET tis620 NOT NULL,
  hn varchar(9) CHARACTER SET tis620 DEFAULT NULL,
  cid varchar(13) CHARACTER SET tis620 DEFAULT NULL,
  chwpart char(2) CHARACTER SET tis620 DEFAULT NULL,
  amppart char(2) CHARACTER SET tis620 DEFAULT NULL,
  tmbpart char(2) CHARACTER SET tis620 DEFAULT NULL,
  moopart char(3) CHARACTER SET tis620 DEFAULT NULL,
  vstdate date DEFAULT NULL,
  vsttime time DEFAULT NULL,
  drinking_type_id int(11) DEFAULT NULL,
  smoking_type_id int(11) DEFAULT NULL,
  PRIMARY KEY (hos_guid)
) ENGINE=InnoDB DEFAULT CHARSET=tis620";
        $this->exec_hosxp_pcu($sql);

        return $this->redirect(['/site/sendsuccess']);
    }

    public function actionWpa()
    {

        $opd = Opdconfig::find()->one();
        $opdconfig = $opd->hospitalcode;

        $sql1 = "
      CREATE TABLE IF NOT EXISTS `wsc_pcu_oapp` (`id` int(11) NOT NULL AUTO_INCREMENT,
  `hospcode` varchar(5) DEFAULT NULL,
  `date_app` date DEFAULT NULL,
  `result` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `remark` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;


CREATE TABLE IF NOT EXISTS `wsc_user` (
  `id` int(11) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;
";
        $this->exec_hosxp_pcu($sql1);

        $sql = "update chospital_amp set version = (select version from version_mPcu) WHERE hoscode = '$opdconfig'";
        $this->exec_master($sql);

        Yii::$app->getSession()->setFlash('success', 'ดำเนินการเรียบร้อยแล้ว!! ');

        return $this->redirect(['/pcu/default/index']);
    }

    public function actionWpa2()
    {

        $sql = file_get_contents(__DIR__ . '/sql/db_update.sql');
        $command = Yii::$app->db2->createCommand($sql);
        $command->execute();

        // Make sure, we fetch all errors
        while ($command->pdoStatement->nextRowSet()) {}
    }



    public function actionUtbl()
    {

        $sql = file_get_contents(__DIR__ . '/sql/wsc_check_token.sql');
        $command = Yii::$app->db2->createCommand($sql);
        $command->execute();

        // Make sure, we fetch all errors
        while ($command->pdoStatement->nextRowSet()) {}
    }
    //ปรับตาราง wsc_clinicmember
    public function actionWscClinicmember()
    {

        $sql = file_get_contents(__DIR__ . '/sql/wsc_clinicmember.sql');
        $command = Yii::$app->db2->createCommand($sql);
        $command->execute();

        // Make sure, we fetch all errors
        while ($command->pdoStatement->nextRowSet()) {}

        Yii::$app->getSession()->setFlash('success', 'ดำเนินการเรียบร้อยแล้ว!! ');

        return $this->redirect(['/pcu/default/index']);
    }

     public function actionNewver()
    {

        $ver = file_get_contents(Yii::getAlias('../version/version.txt'));
      //  $ver = explode(',', $ver);
        echo $ver;

        $sql = "
               update chospital_amp set version = '$ver' where hoscode = '03149'
                ";
        $this->exec_master($sql);
    }

    public function actionWscLabitems()
    {

        $sql = file_get_contents(__DIR__ . '/sql/update_labitems.sql');
        $command = Yii::$app->db2->createCommand($sql);
        $command->execute();

        // Make sure, we fetch all errors
        while ($command->pdoStatement->nextRowSet()) {}
        Yii::$app->getSession()->setFlash('success', 'ดำเนินการเรียบร้อยแล้ว!! ');

        return $this->redirect(['/pcu/default/index']);
    }

    public function actionDrugusage()
    {

        $table2 = date('YmdHis');

        $sql = "CREATE TABLE wsc_drugusage_$table2 LIKE drugusage;
               INSERT wsc_drugusage_$table2 SELECT * FROM drugusage;
                ";
        $this->exec_hosxp_pcu($sql);


        $sql = file_get_contents(__DIR__ . '/sql/drugusage.sql');
        $command = Yii::$app->db2->createCommand($sql);
        $command->execute();

        // Make sure, we fetch all errors
        while ($command->pdoStatement->nextRowSet()) {}
        Yii::$app->getSession()->setFlash('success', 'ดำเนินการเรียบร้อยแล้ว!! ');

        return $this->redirect(['/pcu/default/index']);
    }
    
    
    public function actionPpspecial()
    {

      
        $sql = file_get_contents(__DIR__ . '/sql/wsc_special_type.sql');
        $command = Yii::$app->db2->createCommand($sql);
        $command->execute();

        // Make sure, we fetch all errors
        while ($command->pdoStatement->nextRowSet()) {}
        
        
          $sql2 = file_get_contents(__DIR__ . '/sql/wsc_special_type2.sql');
        $command = Yii::$app->db2->createCommand($sql2);
        $command->execute();

        // Make sure, we fetch all errors
        while ($command->pdoStatement->nextRowSet()) {}
        
        
        $sql = "INSERT INTO pp_special_type
(select (@cnt := @cnt + 1) as pp_special_type_id,pp_special_type_name,null as hos_guid,pp_special_code 
from wsc_special_type 
CROSS JOIN (SELECT @cnt := (select MAX(pp_special_type_id) FROM pp_special_type)) AS dummy
WHERE pp_special_code not in(select pp_special_code FROM pp_special_type));

/*
UPDATE pp_special_type p
INNER JOIN
(select pp_special_type_id,pp_special_type_name as pp_special_type_name2,CAST( pp_special_type_name AS UNSIGNED )as cc  
from pp_special_type where pp_special_code  AND pp_special_type_name not LIKE'%<<ยกเลิก>>%' ORDER BY pp_special_type_id)t
on t.pp_special_type_id = p.pp_special_type_id
SET p.pp_special_type_name = concat(p.pp_special_code,' ',t.pp_special_type_name2)
WHERE t.cc = 0 ;*/

UPDATE pp_special_type p,wsc_special_type ws
set p.pp_special_type_name = ws.pp_special_type_name
where p.pp_special_code = ws.pp_special_code;

/*
UPDATE pp_special_type 
SET pp_special_type_name = concat('<<ยกเลิก>> ' ,pp_special_code)
WHERE pp_special_code = '1B034';
*/

INSERT INTO pp_special_code
select pp_special_code,pp_special_type_name,NULL,NULL from pp_special_type WHERE pp_special_code not in(select `code` FROM pp_special_code);
                ";
        $this->exec_hosxp_pcu($sql);
        
        Yii::$app->getSession()->setFlash('success', 'ดำเนินการเรียบร้อยแล้ว!! ');

        return $this->redirect(['/pcu/default/index']);
    }


    public function actionDrugnew()
    {

        $opd = Opdconfig::find()
            ->one();
        $pcu = $opd->hospitalcode;
        $url = Yii::$app->params['webservice'];
        $url2 = Yii::$app->params['pcuservice'];
        //ตรวจสอบสถานะ API
        try {
            $data_api0 = file_get_contents("$url/drugs");
            $json_api0 = json_decode($data_api0, true);
        } catch (\Exception $e) {
            return $this->redirect(['/site/api-err']);
        }
/*
        try {
            $data_api1 = file_get_contents("$url2/drugs");
            $json_api1 = json_decode($data_api0, true);
        } catch (\Exception $e) {
            return $this->redirect(['/site/api-err']);
        }
*/
      //  $user_id = Yii::$app->params['uid'];

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

        $table2 = date('YmdHis');

        $sql = "CREATE TABLE wsc_drugitems_$table2 LIKE drugitems;
               INSERT wsc_drugitems_$table2 SELECT * FROM drugitems;
                CREATE TABLE wsc_s_drugitems_$table2 LIKE s_drugitems;
               INSERT wsc_s_drugitems_$table2 SELECT * FROM s_drugitems;";
        $this->exec_hosxp_pcu($sql);

        $sql0 = "update drugitems set istatus = 'N';
                  update s_drugitems set istatus = 'N' where icode in(select icode from drugitems);";
        $this->exec_hosxp_pcu($sql0);

        /*
        $sql = file_get_contents(__DIR__ . '/sql/wsc_drugitems.sql');
        $command = Yii::$app->db2->createCommand($sql);
        $command->execute();

        // Make sure, we fetch all errors
        while ($command->pdoStatement->nextRowSet()) {}
         */

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url/drugs", //เปลี่ยนแปลง
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token_",
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);

        foreach ($data['data'] as $key => $item) {

            $icode = $item['icode'];
            $name = $item['name'];
            $strength = $item['strength'];
            $units = $item['units'];
            $unitprice = $item['unitprice'];
            $dosageform = $item['dosageform'];
            $criticalpriority = $item['criticalpriority'];
            $drugaccount = $item['drugaccount'];
            $drugcategory = $item['drugcategory'];
            $drugnote = $item['drugnote'];
            $hintcode = $item['hintcode'];
            $istatus = $item['istatus'];
            $lastupdatestdprice = $item['lastupdatestdprice'];
            $lockprice = $item['lockprice'];
            $lockprint = $item['lockprint'];
            $maxlevel = $item['maxlevel'];
            $minlevel = $item['minlevel'];
            $maxunitperdose = $item['maxunitperdose'];
            $packqty = $item['packqty'];
            $reorderqty = $item['reorderqty'];
            $stdprice = $item['stdprice'];
            $stdtaken = $item['stdtaken'];
            $therapeutic = $item['therapeutic'];
            $therapeuticgroup = $item['therapeuticgroup'];
            $default_qty = $item['default_qty'];
            $gpo_code = $item['gpo_code'];
            $use_right = $item['use_right'];
            $i_type = $item['i_type'];
            $drugusage = $item['drugusage'];
            /*/  $high_cost = $item['high_cost'];*/
            $must_paid = $item['must_paid'];
            $alert_level = $item['alert_level'];
            $access_level = $item['access_level'];
            $sticker_short_name = $item['sticker_short_name'];
            $paidst = $item['paidst'];
            $antibiotic = $item['antibiotic'];
            $displaycolor = $item['displaycolor'];
            $empty = $item['empty'];
            $empty_text = $item['empty_text'];
            $unitcost = $item['unitcost'];
            $ipd_price = $item['ipd_price'];
            $habit_forming = $item['habit_forming'];
            $did = $item['did'];
            $price2 = $item['price2'];
            $price3 = $item['price3'];
            $ipd_price2 = $item['ipd_price2'];
            $ipd_price3 = $item['ipd_price3'];
            $price_lock = $item['price_lock'];
            $pregnancy = $item['pregnancy'];
            $pharmacology_group1 = $item['pharmacology_group1'];
            $pharmacology_group2 = $item['pharmacology_group2'];
            $pharmacology_group3 = $item['pharmacology_group3'];
            $generic_name = $item['generic_name'];
            $show_pregnancy_alert = $item['show_pregnancy_alert'];
            $show_notify = $item['show_notify'];
            $show_notify_text = '##'; /*$item['p_header_sticker'];*/
            $income = $item['income'];
            $print_sticker_pq = $item['print_sticker_pq'];
            $charge_service_opd = $item['charge_service_opd'];
            $charge_service_ipd = $item['charge_service_ipd'];
            $ename = $item['ename'];
            $dose_type = $item['dose_type'];
            $habit_forming_type = $item['habit_forming_type'];
            $no_discount = $item['no_discount'];
            $therapeutic_eng = $item['therapeutic_eng'];
            $hintcode_eng = $item['hintcode_eng'];
            $limit_drugusage = $item['limit_drugusage'];
            $print_sticker_header = $item['p_header_sticker'];
            $calc_idr_qty = $item['calc_idr_qty'];
            $item_in_hospital = $item['item_in_hospital'];
            $no_substock = $item['no_substock'];
            $volume_cc = $item['volume_cc'];
            $usage_code = $item['usage_code'];
            $frequency_code = $item['frequency_code'];
            $time_code = $item['time_code'];
            $dispense_dose = $item['dispense_dose'];
            $usage_unit_code = $item['usage_unit_code'];
            $dose_per_units = $item['dose_per_units'];
            $ipd_default_pay = $item['ipd_default_pay'];
            $continuous = $item['continuous'];
            $substitute_icode = $item['substitute_icode'];
            $fp_drug = $item['fp_drug'];
            $provis_medication_unit_code = $item['provis_medication_unit_code'];
            $sks_product_category_id = $item['sks_product_category_id'];
            $sks_drug_code = $item['sks_drug_code'];
            $sks_dfs_text = $item['sks_dfs_text'];
            $tpu_code_list = $item['tpu_code_list'];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url2/drugs",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{
                \"icode\":\"$icode\",
                \"name\":\"$name\",
                \"strength\":\"$strength\",
                \"units\":\"$units\",
                \"unitprice\":\"$unitprice\",
                \"dosageform\":\"$dosageform\",
                \"criticalpriority\":\"$criticalpriority\",
                \"drugaccount\":\"$drugaccount\",
                \"drugcategory\":\"$drugcategory\",
                \"drugnote\":\"$drugnote\",
                \"hintcode\":\"$hintcode\",
                \"istatus\":\"$istatus\",
                \"lastupdatestdprice\":\"$lastupdatestdprice\",
                \"lockprice\":\"$lockprice\",
                \"lockprint\":\"$lockprint\",
                \"maxlevel\":\"$maxlevel\",
                \"minlevel\":\"$minlevel\",
                \"maxunitperdose\":\"$maxunitperdose\",
                \"packqty\":\"$packqty\",
                \"reorderqty\":\"$reorderqty\",
                \"stdprice\":\"$stdprice\",
                \"stdtaken\":\"$stdtaken\",
                \"therapeutic\":\"$therapeutic\",
                \"therapeuticgroup\":\"$therapeuticgroup\",
                \"default_qty\":\"$default_qty\",
                \"gpo_code\":\"$gpo_code\",
                \"use_right\":\"$use_right\",
                \"i_type\":\"$i_type\",
                \"drugusage\":\"$drugusage\",
                \"must_paid\":\"$must_paid\",
                \"alert_level\":\"$alert_level\",
                \"access_level\":\"$access_level\",
                \"sticker_short_name\":\"$sticker_short_name\",
                \"paidst\":\"$paidst\",
                \"antibiotic\":\"$antibiotic\",
                \"displaycolor\":\"$displaycolor\",
                \"empty\":\"$empty\",
                \"empty_text\":\"$empty_text\",
                \"unitcost\":\"$unitcost\",
                \"ipd_price\":\"$ipd_price\",
                \"habit_forming\":\"$habit_forming\",
                \"did\":\"$did\",
                \"price2\":\"$price2\",
                \"price3\":\"$price3\",
                \"ipd_price2\":\"$ipd_price2\",
                \"ipd_price3\":\"$ipd_price3\",
                \"price_lock\":\"$price_lock\",
                \"pregnancy\":\"$pregnancy\",
                \"pharmacology_group1\":\"$pharmacology_group1\",
                \"pharmacology_group2\":\"$pharmacology_group2\",
                \"pharmacology_group3\":\"$pharmacology_group3\",
                \"generic_name\":\"$generic_name\",
                \"show_pregnancy_alert\":\"$show_pregnancy_alert\",
                \"show_notify\":\"$show_notify\",
                \"show_notify_text\":\"$show_notify_text\",
                \"income\":\"$income\",
                \"print_sticker_pq\":\"$print_sticker_pq\",
                \"charge_service_opd\":\"$charge_service_opd\",
                \"charge_service_ipd\":\"$charge_service_ipd\",
                \"ename\":\"$ename\",
                \"dose_type\":\"$dose_type\",
                \"habit_forming_type\":\"$habit_forming_type\",
                \"no_discount\":\"$no_discount\",
                \"therapeutic_eng\":\"$therapeutic_eng\",
                \"hintcode_eng\":\"$hintcode_eng\",
                \"limit_drugusage\":\"$limit_drugusage\",
                \"print_sticker_header\":\"$print_sticker_header\",
                \"calc_idr_qty\":\"$calc_idr_qty\",
                \"item_in_hospital\":\"$item_in_hospital\",
                \"no_substock\":\"$no_substock\",
                \"volume_cc\":\"$volume_cc\",
                \"usage_code\":\"$usage_code\",
                \"frequency_code\":\"$frequency_code\",
                \"time_code\":\"$time_code\",
                \"dispense_dose\":\"$dispense_dose\",
                \"usage_unit_code\":\"$usage_unit_code\",
                \"dose_per_units\":\"$dose_per_units\",
                \"ipd_default_pay\":\"$ipd_default_pay\",
                \"continuous\":\"$continuous\",
                \"substitute_icode\":\"$substitute_icode\",
                \"fp_drug\":\"$fp_drug\",
                \"provis_medication_unit_code\":\"$provis_medication_unit_code\",
                \"sks_product_category_id\":\"$sks_product_category_id\",
                \"sks_drug_code\":\"$sks_drug_code\",
                \"sks_dfs_text\":\"$sks_dfs_text\",
                \"tpu_code_list\":\"$tpu_code_list\"
                    }",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer $token_",
                    "Content-Type: application/json",
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

        }

        // s_drugitems

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url/drugs/sdrug", //เปลี่ยนแปลง
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token_",
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);

        foreach ($data['data'] as $key => $item) {

            $icode = $item['icode'];
            $name = $item['name'];
            $strength = $item['strength'];
            $units = $item['units'];
            $dosageform = $item['dosageform'];
            $drugnote = $item['drugnote'];
            $use_right = $item['use_right'];
            $must_paid = $item['must_paid'];
            $istatus = $item['istatus'];
            $access_level = $item['access_level'];
            $paidst = $item['paidst'];
            $displaycolor = $item['displaycolor'];
            $price_lock = $item['price_lock'];
            $ename = $item['ename'];
            $cost = $item['cost'];
            $income = $item['income'];
            $is_medication = $item['is_medication'];
            $is_medsupply = $item['is_medsupply'];
            /* $highcost = $item['highcost'];*/
            $unitprice = $item['unitprice'];
            $tpu_code_list = $item['tpu_code_list'];
            $drugaccount = $item['drugaccount'];
            $sks_drug_code = $item['sks_drug_code'];
            $sks_product_category_id = $item['sks_product_category_id'];
            $drugcategory = $item['drugcategory'];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url2/drugs/sdrug",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{
                \"icode\":\"$icode\",
                \"name\":\"$name\",
                \"strength\":\"$strength\",
                \"units\":\"$units\",
                \"dosageform\":\"$dosageform\",
                \"drugnote\":\"$drugnote\",
                \"use_right\":\"$use_right\",
                \"must_paid\":\"$must_paid\",
                \"istatus\":\"$istatus\",
                \"access_level\":\"$access_level\",
                \"paidst\":\"$paidst\",
                \"displaycolor\":\"$displaycolor\",
                \"price_lock\":\"$price_lock\",
                \"ename\":\"$ename\",
                \"cost\":\"$cost\",
                \"income\":\"$income\",
                \"is_medication\":\"$is_medication\",
                \"is_medsupply\":\"$is_medsupply\",
                \"unitprice\":\"$unitprice\",
                \"tpu_code_list\":\"$tpu_code_list\",
                \"drugaccount\":\"$drugaccount\",
                \"sks_drug_code\":\"$sks_drug_code\",
                \"sks_product_category_id\":\"$sks_product_category_id\",
                \"drugcategory\":\"$drugcategory\"
                    }",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer $token_",
                    "Content-Type: application/json",
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

        }

        Yii::$app->getSession()->setFlash('success', 'ดำเนินการเรียบร้อยแล้ว!! ');

        return $this->redirect(['/pcu/default/index']);

    }

    public function actionDrugitemsrep()
    {

        $icode = '';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url/drugs/$icode", //เปลี่ยนแปลง
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                // "Authorization: Bearer $token_",
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);

        foreach ($data['data'] as $key => $item) {

            $HOSPCODE = $item['HOSPCODE'];
            $PID = $item['PID'];
            $SEQ = $item['SEQ'];
            $DATE_SERV = $item['DATE_SERV'];
            $VACCINETYPE = $item['VACCINETYPE'];
            $VACCINEPLACE = $item['VACCINEPLACE'];
            $PROVIDER = $item['PROVIDER'];
            $D_UPDATE = $item['D_UPDATE'];
            $apicheck = $item['apicheck'];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url/f43imports/epi",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{
                \"HOSPCODE\":\"$HOSPCODE\",
                \"PID\":\"$PID\",
                \"SEQ\":\"$SEQ\",
                \"DATE_SERV\":\"$DATE_SERV\",
                \"VACCINETYPE\":\"$VACCINETYPE\",
                \"VACCINEPLACE\":\"$VACCINEPLACE\",
                \"PROVIDER\":\"$PROVIDER\",
                \"D_UPDATE\":\"$D_UPDATE\"
                    }",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer $token_",
                    "Content-Type: application/json",
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

        }

    }

    public function actionOpdallergy()
    {

        $opd = Opdconfig::find()
            ->one();
        $pcu = $opd->hospitalcode;
        $url = Yii::$app->params['webservice'];
        $url2 = Yii::$app->params['pcuservice'];
        //ตรวจสอบสถานะ API
        try {
            $data_api0 = file_get_contents($url);
            $json_api0 = json_decode($data_api0, true);
        } catch (\Exception $e) {
            return $this->redirect(['/site/api-err']);
        }

        try {
            $data_api1 = file_get_contents($url2);
            $json_api1 = json_decode($data_api0, true);
        } catch (\Exception $e) {
            return $this->redirect(['/site/api-err']);
        }

       // $user_id = Yii::$app->params['uid'];

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

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url/persons/allergycheckupdate", //เปลี่ยนแปลง
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token_",
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);

//   $datacount = sizeof($data['data']);
        //  echo $response;

        foreach ($data['data'] as $key => $item) {

            $cid_encrypt2 = $item['cid_encrypt'];
          //  $check_edit2 = $item['check_edit'];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url2/persons/cidencrypt",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{
                \"cid_encrypt\":\"$cid_encrypt2\"
                    }",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer $token_",
                    "Content-Type: application/json",
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
        }

        $sql = "select upper(md5(concat('r9',cid,'refer#09'))) as cid 
        from patient WHERE  upper(md5(concat('r9',cid,'refer#09'))) 
        in (select cid_encrypt from wsc_cid_encrypt)";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $cid = $data['cid'];

//  $last_check = date('Y-m-d H:i:s');
            //  $sql = "REPLACE INTO wsc_check_patient(cid,last_check)
            //       VALUE('$cid','$last_check')";
            //   $this->exec_hosxp_pcu($sql);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url/persons/opdallergy/$cid", //เปลี่ยนแปลง
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => "",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer $token_",
                    "Content-Type: application/json",
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $data = json_decode($response, true);

//   $datacount = sizeof($data['data']);
            // echo $datacount;

            foreach ($data['data'] as $key => $item) {

                $hn = $item['hn'];
                $report_date = $item['report_date'];
                $agent = $item['agent'];
                $symptom = $item['symptom'];
                $reporter = $item['reporter'];
                $note = $item['note'];
                $allergy_group_id = $item['allergy_group_id'];
                $seriousness_id = $item['seriousness_id'];
                $allergy_result_id = $item['allergy_result_id'];
                $allergy_relation_id = $item['allergy_relation_id'];
                $patient_cid = $item['patient_cid'];
                $entry_datetime = $item['entry_datetime'];
                $update_datetime = $item['update_datetime'];
                $force_no_order = $item['force_no_order'];
                $opd_allergy_alert_type_id = $item['opd_allergy_alert_type_id'];
                $opd_allergy_source_id = $item['opd_allergy_source_id'];
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$url2/f43exports/opdallergy",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "{
                \"hn\":\"$hn\",
                \"report_date\":\"$report_date\",
                \"agent\":\"$agent\",
                \"symptom\":\"$symptom\",
                \"reporter\":\"$reporter\",
                \"note\":\"$note\",
                \"allergy_group_id\":\"$allergy_group_id\",
                \"seriousness_id\":\"$seriousness_id\",
                \"allergy_result_id\":\"$allergy_result_id\",
                \"allergy_relation_id\":\"$allergy_relation_id\",
                 \"patient_cid\":\"$patient_cid\",
                 \"entry_datetime\":\"$entry_datetime\",
                 \"update_datetime\":\"$update_datetime\",
                 \"force_no_order\":\"$force_no_order\",
                  \"opd_allergy_alert_type_id\":\"$opd_allergy_alert_type_id\",
                  \"opd_allergy_source_id\":\"$opd_allergy_source_id\"
                    }",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer $token_",
                        "Content-Type: application/json",
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
            }
        }

        $sql = "call mpcu_opd_allergy_importpcu";
        $this->exec_hosxp_pcu($sql);

        Yii::$app->getSession()->setFlash('success', 'ดำเนินการเรียบร้อยแล้ว!! ');

        return $this->redirect(['/pcu/default/index']);

    }

    public function actionSmdrtohos()
    {

        $opd = Opdconfig::find()
            ->one();
        $pcu = $opd->hospitalcode;
        $url = Yii::$app->params['webservice'];
        $url2 = Yii::$app->params['pcuservice'];
        //ตรวจสอบสถานะ API
        try {
            $data_api0 = file_get_contents("$url");
            $json_api0 = json_decode($data_api0, true);
        } catch (\Exception $e) {
            return $this->redirect(['/site/api-err']);
        }

      //  $user_id = Yii::$app->params['uid'];
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

        echo $token_ ;

       


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url/hostowscs/smdrtopcu/$pcu", //เปลี่ยนแปลง
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token_",
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);

       // echo $userHost = Yii::$app->request->userHost;

       //echo $response;

        foreach ($data['data'] as $key => $item) {

            $cid = $item['cid'];
            $pp_special_code = $item['pp_special_code'];
            $vstdate2 = $item['vstdate2'];

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url2/fromwscs/ppstohos",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{
                \"cid\":\"$cid\",
                \"pp_special_code\":\"$pp_special_code\",
                \"vstdate2\":\"$vstdate2\"
                    }",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer $token_",
                    "Content-Type: application/json",
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

        }

       

        Yii::$app->getSession()->setFlash('success', 'ดำเนินการเรียบร้อยแล้ว!! ');

        return $this->redirect(['/pcu/default/index']);

    }

    public function actionSmdrtohosall()
    {

        $opd = Opdconfig::find()
            ->one();
        $pcu = $opd->hospitalcode;
        $url = Yii::$app->params['webservice'];
        $url2 = Yii::$app->params['pcuservice'];
        //ตรวจสอบสถานะ API
        try {
            $data_api0 = file_get_contents("$url");
            $json_api0 = json_decode($data_api0, true);
        } catch (\Exception $e) {
            return $this->redirect(['/site/api-err']);
        }

      //  $user_id = Yii::$app->params['uid'];

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

        $table2 = date('YmdHis');


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url/hostowscs/smdrtopcuall/$pcu", //เปลี่ยนแปลง
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $token_",
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);
      
       //echo $response;

        foreach ($data['data'] as $key => $item) {

            $cid = $item['cid'];
            $pp_special_code = $item['pp_special_code'];
            $vstdate2 = $item['vstdate2'];

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url2/fromwscs/ppstohos",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{
                \"cid\":\"$cid\",
                \"pp_special_code\":\"$pp_special_code\",
                \"vstdate2\":\"$vstdate2\"
                    }",
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer $token_",
                    "Content-Type: application/json",
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

        }

        /*

        Yii::$app->getSession()->setFlash('success', 'ดำเนินการเรียบร้อยแล้ว!! ');

        return $this->redirect(['/pcu/default/index']);*/

    }



}
