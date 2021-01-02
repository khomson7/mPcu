<?php

namespace app\modules\pcureport\controllers;

use app\modules\pcu\models\Opdconfig;
use app\modules\pcu\models\ReportLog;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `pcureport` module
 */
class ApidataController extends Controller
{

    protected function exec_hosxp_pcu($sql = null)
    {
        return \Yii::$app->db2->createCommand($sql)->execute();
    }
    /**
     * Renders the index view for the module
     * @return string
     */

    //ข้อมูล labs/chroniclab/:cid

    public function actionFlab($user = null)
    {

        $url = Yii::$app->params['webservice'];

        if ($user == null) {
            $user = '#'; //หากยังไม่ได้ post ค่า
        }
        //เรียกข้อมูลไปแสดงที่ grid
        $sql = "select t2.* FROM
(select CASE WHEN count(person_id)< 1 THEN '-'
ELSE concat(fname,' ',lname)
END as ptname,concat(DATE_FORMAT(birthdate,'%d/%m/'),DATE_FORMAT(birthdate,'%Y')+543) as birthdate
,TIMESTAMPDIFF(YEAR,birthdate,date(NOW())) as age_y,h.address,v.village_name
FROM
(select * from person
where upper(md5(concat('r9',cid,'refer#09'))) = '$user')t
LEFT JOIN village v on v.village_id = t.village_id
LEFT JOIN house h on h.house_id = t.house_id

UNION

select concat(fname,' ',lname) ptname,concat(DATE_FORMAT(birthdate,'%d/%m/'),DATE_FORMAT(birthdate,'%Y')+543) as birthdate
,TIMESTAMPDIFF(YEAR,birthdate,date(NOW())) as age_y,h.address,v.village_name
from person p
LEFT JOIN village v on v.village_id = p.village_id
LEFT JOIN house h on h.house_id = p.house_id
where upper(md5(concat('r9',cid,'refer#09'))) = '$user'
)t2
GROUP BY t2.ptname
LIMIT 1";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $ptname = $data['ptname'];
            $birthdate = $data['birthdate'];
            $age_y = $data['age_y'];
            $address = $data['address'];
            $village_name = $data['village_name'];
        }

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

        $data = Yii::$app->request->post();
        if (!\Yii::$app->user->isGuest) {
            $user_id = \Yii::$app->user->identity->id;
            $sql = "select token_ from wsc_check_token where id = '$user_id'";
            $data = Yii::$app->db2->createCommand($sql)->queryAll();
            if (!$user_id) {
                throw new \Exception;
            }
            foreach ($data as $data) {
                $token_ = $data['token_'];
            }
            try {

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$url/labs/chroniclab/$user", //เปลี่ยนแปลง
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer $token_",
                        "Content-Type: application/json",
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                $data = json_decode($response, true);

                $dataProvider = new ArrayDataProvider([
                    'allModels' => $data,
                    'pagination' => false, /* [
                    'pageSize' => 3,
                    ] , */
                    'sort' => [
                        'attributes' => ['id'],
                    ],
                ]);
            } catch (\Exception $e) {

                //echo "ท่านไม่ได้รับสิทธ";
                return $this->redirect(['/site/api-err']);
            }
        }

        return $this->render('flab', [
            'user' => $user,
            'ptname' => $ptname,
            'birthdate' => $birthdate,
            'age_y' => $age_y,
            'address' => $address,
            'village_name' => $village_name,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionEpidetail($user = null)
    {

        if ($user == null) {
            $user = '#'; //หากยังไม่ได้ post ค่า
        }
        //เรียกข้อมูลไปแสดงที่ grid
        $sql = "select t2.* FROM
(select CASE WHEN count(person_id)< 1 THEN '-'
ELSE concat(fname,' ',lname)
END as ptname,concat(DATE_FORMAT(birthdate,'%d/%m/'),DATE_FORMAT(birthdate,'%Y')+543) as birthdate
,TIMESTAMPDIFF(YEAR,birthdate,date(NOW())) as age_y,h.address,v.village_name
FROM
(select * from person
where upper(md5(concat('r9',cid,'refer#09'))) = '$user')t
LEFT JOIN village v on v.village_id = t.village_id
LEFT JOIN house h on h.house_id = t.house_id

UNION

select concat(fname,' ',lname) ptname,concat(DATE_FORMAT(birthdate,'%d/%m/'),DATE_FORMAT(birthdate,'%Y')+543) as birthdate
,TIMESTAMPDIFF(YEAR,birthdate,date(NOW())) as age_y,h.address,v.village_name
from person p
LEFT JOIN village v on v.village_id = p.village_id
LEFT JOIN house h on h.house_id = p.house_id
where upper(md5(concat('r9',cid,'refer#09'))) = '$user'
)t2
GROUP BY t2.ptname
LIMIT 1";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $ptname = $data['ptname'];
            $birthdate = $data['birthdate'];
            $age_y = $data['age_y'];
            $address = $data['address'];
            $village_name = $data['village_name'];
        }

        $opd = Opdconfig::find()
            ->one();
        $opdconfig = $opd->hospitalcode;

        $id = '29'; //เลขจากตาราง hos_basedata_sub
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
        if (!\Yii::$app->user->isGuest) {
            $user_id = \Yii::$app->user->identity->id;
            $sql = "select token_ from wsc_check_token where id = '$user_id'";
            $data = Yii::$app->db2->createCommand($sql)->queryAll();
            if (!$user_id) {
                throw new \Exception;
            }
            foreach ($data as $data) {
                $token_ = $data['token_'];
            }
            try {
                $url = Yii::$app->params['pcuservice'];

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$url/epis/epidetail/$user", //เปลี่ยนแปลง
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer $token_",
                        "Content-Type: application/json",
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                $data = json_decode($response, true);

                $dataProvider = new ArrayDataProvider([
                    'allModels' => $data,
                    'pagination' => false, /* [
                    'pageSize' => 3,
                    ] , */
                    'sort' => [
                        'attributes' => ['id'],
                    ],
                ]);

                $url2 = Yii::$app->params['webservice'];

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$url2/epis/epidetail/$user", //เปลี่ยนแปลง
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer $token_",
                        "Content-Type: application/json",
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                $data = json_decode($response, true);

                $dataProvider2 = new ArrayDataProvider([
                    'allModels' => $data,
                    'pagination' => false, /* [
                    'pageSize' => 3,
                    ] , */
                    'sort' => [
                        'attributes' => ['id'],
                    ],
                ]);

            } catch (\Exception $e) {

                //echo "ท่านไม่ได้รับสิทธ";
                return $this->redirect(['/site/api-err']);
            }
        }

        return $this->render('epidetail', [
            'user' => $user,
            'ptname' => $ptname,
            'birthdate' => $birthdate,
            'age_y' => $age_y,
            'address' => $address,
            'village_name' => $village_name,
            'dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,
        ]);
    }
}
