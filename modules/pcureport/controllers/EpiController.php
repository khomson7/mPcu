<?php

namespace app\modules\pcureport\controllers;

use app\config\components\AppController;
use app\modules\pcu\models\Opdconfig;
use app\modules\pcu\models\ReportLog;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `pcureport` module
 */
class EpiController extends AppController
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

        $basedata_id = '4';

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

    public function actionFepi($user = null)
    {
        $url = Yii::$app->params['webservice'];

        if ($user == null) {
            $user = '#';
        }
        /*
        $encoded = bin2hex("$user");
        $encoded = chunk_split($encoded, 2, '%');
        $encoded = '%' . substr($encoded, 0, strlen($encoded) - 1);
        $user = $encoded;
         */

        $sql = "select t2.* FROM
(select CASE WHEN count(person_id)< 1 THEN '-'
ELSE concat(fname,' ',lname)
END as ptname,concat(DATE_FORMAT(birthdate,'%d/%m/'),DATE_FORMAT(birthdate,'%Y')+543) as birthdate
FROM
(select * from person
where cid = '$user')t

UNION

select concat(fname,' ',lname) ptname,concat(DATE_FORMAT(birthdate,'%d/%m/'),DATE_FORMAT(birthdate,'%Y')+543) as birthdate
from person
where cid = '$user'
)t2
GROUP BY t2.ptname
LIMIT 1";
        $data = Yii::$app->db2->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $ptname = $data['ptname'];
            $birthdate = $data['birthdate'];
        }

        $opd = Opdconfig::find()
            ->one();
        $opdconfig = $opd->hospitalcode;

        $id = '17'; //เลขจากตาราง hos_basedata_sub
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

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url/epis/$user", //เปลี่ยนแปลง
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
                'pagination' => false, /*[
                'pageSize' => 3,
                ] ,*/
                'sort' => [
                    'attributes' => ['id'],
                ],
            ]);

            return $this->render('fepi', [
                'user' => $user,
                'ptname' => $ptname,
                'birthdate' => $birthdate,
                'dataProvider' => $dataProvider,

            ]);
        }
    }

    public function actionEpiperson()
    {

        $opd = Opdconfig::find()
            ->one();
        $opdconfig = $opd->hospitalcode;

        $id = '30'; //เลขจากตาราง hos_basedata_sub
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

            try {

                $url = Yii::$app->params['pcuservice'];
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$url/epis/epi2", //เปลี่ยนแปลง
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
                    'pagination' => [
                        'pageSize' => 10,
                    ],
                    'sort' => [
                        'attributes' => ['id'],
                    ],
                ]);

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "$url/epis/epivaccine", //เปลี่ยนแปลง
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
                    'pagination' => [
                        'pageSize' => 50,
                    ],
                    'sort' => [
                        'attributes' => ['id'],
                    ],
                ]);
            } catch (\Exception $e) {

                //echo "ท่านไม่ได้รับสิทธ";
                return $this->redirect(['/site/api-err']);
            }
        }

        return $this->render('epiperson', [
            //'t' => $t,
            // 'basedata_id' => $basedata_id,
            // 'id' => $id,
            'base_data' => $base_data,
            'dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,

        ]);
    }

}
