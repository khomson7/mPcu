<?php

namespace app\modules\pcu\controllers;

use Yii;
use app\modules\pcu\models\MIcd101;
use app\modules\pcu\models\MIcd101Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\pcu\models\Opdconfig;
use app\config\components\AppController;
use app\modules\pcu\models\ReportLog;
use app\modules\pcu\models\MIcd10HealthMed;

/**
  /**
 * MIcd101Controller implements the CRUD actions for MIcd101 model.
 */
class MIcd101Controller extends AppController {

    protected function exec_hosxp_pcu($sql = null) {
        return \Yii::$app->db2->createCommand($sql)->execute();
    }

    public function actionIndex() {
        $searchModel = new MIcd101Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelsicd = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $req = \Yii::$app->request;  //ประกาศตัวแปร
            $post = $req->post();

            //ส่งค่าจาก model ให้ตัวแปร
            $code = $post['MIcd101'] ['code'];
            $name = $post['MIcd101'] ['name'];
            $spclty = $post['MIcd101'] ['spclty'];
            $tname = $post['MIcd101'] ['tname'];
            $code3 = $post['MIcd101'] ['code3'];
            $code4 = $post['MIcd101'] ['code4'];
            $code5 = $post['MIcd101'] ['code5'];
            $sex = $post['MIcd101'] ['sex'];
            $ipd_valid = $post['MIcd101'] ['ipd_valid'];
            $icd10compat = $post['MIcd101'] ['icd10compat'];
            $icd10tmcompat = $post['MIcd101'] ['icd10tmcompat'];
            $active_status = $post['MIcd101'] ['active_status'];





            $sql = "REPLACE INTO icd101(code,name,spclty,tname,code3,code4,code5,sex,ipd_valid,icd10compat,icd10tmcompat,active_status) VALUES  
                     ('$code','$name','$spclty','$tname','$code3','$code4','$code5','$sex','$ipd_valid','$icd10compat','$icd10tmcompat','$active_status')";
            $this->exec_hosxp_pcu($sql);
            

            $sql2 = "REPLACE INTO icd10_health_med(icd10,name)
                    VALUE('$code','$name')";
            $this->exec_hosxp_pcu($sql2);


            $model->save();

            if (\Yii::$app->request->isPost) {

                $opd = Opdconfig::find()
                        ->one();
                $opdconfig = $opd->hospitalcode;

                $model = \app\modules\pcu\models\Icd10HealthMed::find()->select('icd10')
                        ->all();

                $query = MIcd10HealthMed::find()
                        ->where(['NOT IN', 'icd10', $model])
                        ->count();

                $id = '11';
                $log = new ReportLog();
                $log->code_data = $code;
                $log->user_id = \Yii::$app->user->identity->id;
                $log->datetime = date('Y-m-d H:i:s');
                $log->data_index_id = $id;
                $log->ip = \Yii::$app->request->getUserIP();
                $log->save();
            }

            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
                    'model' => $model,
                    'modelsicd' => $modelsicd,
        ]);
    }

    protected function findModel($id) {
        if (($model = MIcd101::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
