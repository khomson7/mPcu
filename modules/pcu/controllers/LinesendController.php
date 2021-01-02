<?php

namespace app\modules\pcu\controllers;

use app\modules\pcu\models\Opdconfig;
use Yii;
use app\modules\pcu\models\OpdAllergy;
use app\modules\pcu\models\MOpdAllergy;
use app\modules\pcu\models\WscPcuOapp;

class LinesendController extends \yii\web\Controller {

    protected function exec_hosxp_pcu($sql = NULL) {
        return \Yii::$app->db2->createCommand($sql)->execute();
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionCurltch() {

        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $sql0 = "select ip_serve from chospital_amp where hoscode = '$opdconfig'";

        try {
            $data = \Yii::$app->db->createCommand($sql0)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }

        foreach ($data as $data) {
            $ip_serv = $data['ip_serve'];
        }

        $befor_date = (new \DateTime())->format('Y-m-d');



        $sql = "select count(s1.cid) as cc,concat(date_format(now(),'%d-%m-'),date_format(now(),'%Y')+543) as date_report
from person p 
LEFT JOIN village v on v.village_id = p.village_id
LEFT JOIN house h on h.house_id = p.house_id
INNER JOIN t_childdev_specialpp s1 on s1.cid = p.cid
WHERE date(NOW()) BETWEEN s1.date_start AND date_end
AND date_serv_first is NULL";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $cc = $data['cc'];
            $date_report = $data['date_report'];
        }

        $thread = $cc;
        $d_send = $date_report;
        $link = 'http://' . $ip_serv . '/mPcu/web/index.php?r=pcureport/kpi/sp9-to60';

        if ($thread != 0) {



            $message = 'วันที่ ' . $d_send . '{' . $opdconfig . '} รอคัดกรองพัฒนาการ จำนวน ' . $thread . ' ราย ,สามารถเข้าดูรายละเอียดได้ที่ => ' . $link;

            $res = $this->notify_tch($message);

            return $this->redirect(['/pcu/linesend/curlopdallergy']);
        } else if ($thread == 0) {
            return $this->redirect(['/pcu/linesend/curlopdallergy']);
        }
    }

    public function actionCurlopdallergy() {



        $model = OpdAllergy::find()->select(['concat(hn,agent)'])->asArray()
                ->all();


        $query = MOpdAllergy::find()
                //  ->asArray()
                ->where(['NOT IN', ['concat(hn,agent)'], $model])
                ->count();




        $thread = $query;
        $link = 'http://127.0.0.1/mPcu/web/index.php?r=pcureport/kpi/sp9-60';

        if ($thread != 0) {



            $message = ' ข้อมูลแพ้ยารอนำเข้า ' . $query . ' รายการ';
            //  $message = $thread ;
            $res = $this->notify_tch($message);
            //  $thread->status_befor = '0';
            // $thread->save();

            return $this->redirect(['/pcu/linesend/curlchkback']);
        } else if ($thread == 0) {
            return $this->redirect(['/pcu/linesend/curlchkback']);
            // return $this->redirect(['/pcu/default/index']);
        }
    }

    public function actionCurlchkback() {

        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $link0 = \app\modules\pcu\models\ChospitalAmp::find()->select('ip_serve')
                ->where('hoscode = :hoscode', [':hoscode' => $opdconfig])
                ->all();

        $befor_date = (new \DateTime())->format('Y-m-d');



        $sql = "SELECT datetime,round((count_data/1024)/1024,0) as data 
FROM check_backup_log WHERE idkey in
(select max(idkey) 
from check_backup_log WHERE hosp_code = '$opdconfig')";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $datetime = $data['datetime'];
            $data = $data['data'];
        }

        $thread = $data;
        //$link = 'http://127.0.0.1/mPcu/web/index.php?r=pcureport/kpi/sp9-60';

        if ($thread != null) {



            $message = '{' . $opdconfig . '} สำรองข้อมูลล่าสุด ' . $datetime . ' ขนาดข้อมูล => ' . $data . ' Mb';
            //  $message = $thread ;
            $res = $this->notify_tch($message);
            //  $thread->status_befor = '0';
            // $thread->save();
            // return $this->redirect(['/line/linebot/patienthospitalsick']);
        } else
            return $this->redirect(['/pcu/default/index']);
    }

    public function notify_tch($message) {
        /*
          $status_befor = '1';
          $befor_time = '06:00:00';
          $befor_date = (new \DateTime())->format('Y-m-d');



          $thread = MyJob::find()
          ->where('befor_date= :befor_date', [':befor_date' => $befor_date])
          ->andWhere('status_befor= :status_befor', [':status_befor' => $status_befor])
          ->andWhere('befor_time= :befor_time', [':befor_time' => $befor_time])
          ->orderBy(['id' => SORT_ASC])->one();


          $user_id = $thread->user_id;
         */
        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $rows = (new \yii\db\Query())
                ->select(['line_token'])
                ->from('chospital_amp')
                ->where('hoscode = :hoscode', [':hoscode' => $opdconfig])
                ->all();

        foreach ($rows as $rows) {

            //  $token_= $rows['token_'];
            $line_token = $rows['line_token'];
            //   $i = $rows['username_id'];

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
            // $context2 = stream_context_create($headerOptions2);
            $result = file_get_contents($line_api, FALSE, $context);
            // $result = file_get_contents($line_api, FALSE, $context2);
        }
        $res = json_decode($result);
        return $res;
    }

    public function actionCurloapp() {
        
        $sql0 = "update wsc_pcu_oapp set oaid = concat(hospcode,date_app,result) where oaid = ''";
        $this->exec_hosxp_pcu($sql0);
        
               $thread0 = WscPcuOapp::find()
               ->where("send_state = 1")
                 ->count();
        
               
   if ($thread0 == 0)  {
           // return $this->redirect(['/pcu/wsc-pcu-oapp/index']);
       
       
            
        $sql = "select hospcode,concat(date_format(date_app,'%d/%m/'),date_format(date_app,'%Y')+543) as sendfile 
                    ,result
                    from wsc_pcu_oapp order by oaid desc LIMIT 1";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $oaid = $data['oaid'];
            $sendfile = $data['sendfile'];
            $result = $data['result'];
            $hospcode = $data['hospcode'];
        }
        $sql = "select hosname from chospital_amp where hoscode = $hospcode";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $hosname = $data['hosname'];
        }


        $thread = WscPcuOapp::find()
               ->where("oaid = '$oaid' and send_state = 1")
                ->limit(1)
                ->all();
   
       
   
        if ($thread != NULL) {
            $message = '{ ' . ' วันที่ ' . $sendfile . ' ' . $hosname . ' นัดคนไข้เรื้อรังจำนวน : ' . $result . ' คน }';
            $res = $this->notify_message($message);
            
            }
            return $this->redirect(['/pcu/wsc-pcu-oapp/index']);
        }
    }

    public function actionCurloapp2() {
        
        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $sql0 = "REPLACE INTO wsc_pcu_oapp(oaid,hospcode,date_app,result)
select * FROM
(select concat((select hospitalcode from opdconfig),nextdate,count(vn)) as oaid,(select hospitalcode from opdconfig) as hospcode,nextdate,count(vn) as result
from oapp  WHERE  nextdate > NOW()
AND nextdate in(select date_work FROM wsc_t_work_pcu) 
GROUP BY nextdate ASC)t where t.oaid not in(select oaid from wsc_pcu_oapp)";
        $this->exec_hosxp_pcu($sql0);


        $sql = "select oaid,hospcode,concat(date_format(date_app,'%d/%m/'),date_format(date_app,'%Y')+543) as sendfile 
                    ,result
                    from wsc_pcu_oapp where send_state = '1' LIMIT 1";




        $data = Yii::$app->db2->createCommand($sql)->queryAll();


        foreach ($data as $data) {
            $oaid = $data['oaid'];
            $sendfile = $data['sendfile'];
            $result = $data['result'];
            $hospcode = $data['hospcode'];
        }




        $sql = "select hosname from chospital_amp where hoscode = $opdconfig";




        $data = Yii::$app->db->createCommand($sql)->queryAll();


        foreach ($data as $data) {
            $hosname = $data['hosname'];
        }


        $thread = WscPcuOapp::find()
                ->where("oaid = '$oaid' and send_state = 1")
                ->limit(1)
                ->all();

        if ($thread != NULL) {
            $message = '{ ' . ' วันที่ ' . $sendfile . ' ' . $hosname . ' นัดคนไข้เรื้อรังจำนวน : ' . $result . ' คน }';
            $res = $this->notify_message($message);
            // return $this->redirect(['/pcu/wsc-pcu-oapp/index']);


            $sql2 = "update wsc_pcu_oapp set send_state = '0' where oaid = '$oaid'";
            $this->exec_hosxp_pcu($sql2);
        }
    }

    public function notify_message($message) {
        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $sql = "select line_token as token_,null as username_id from chospital_amp where hoscode = $opdconfig limit 1";
        
        $rows = (new \yii\db\Query())
                ->select(['token_', 'tbl_token_sendline.username_id'])
                ->from('tbl_token')
                ->join('LEFT OUTER JOIN', 'tbl_token_sendline', 'tbl_token_sendline.username_id =tbl_token.username_id')
                ->where([
                    'tbl_token_sendline.hoscode' => [$opdconfig]
                ])
               
                  ->union($sql)
                 
                ->all();

        foreach ($rows as $rows) {

            //  $token_= $rows['token_'];
            $line_token = $rows['token_'];
            $i = $rows['username_id'];

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
            // $context2 = stream_context_create($headerOptions2);
            $result = file_get_contents($line_api, FALSE, $context);
            // $result = file_get_contents($line_api, FALSE, $context2);
        }
        $res = json_decode($result);
        return $res;
    }

}
