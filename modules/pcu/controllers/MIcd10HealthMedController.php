<?php

namespace app\modules\pcu\controllers;

use Yii;
use yii\base\Model;
use app\modules\pcu\models\MIcd10HealthMed;
use app\modules\pcu\models\MIcd10HealthMedSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\config\components\AppController;
use app\modules\pcu\models\ReportLog;
use app\modules\pcu\models\Opdconfig;
use app\modules\pcu\models\CountDataPcu;
use app\modules\pcu\models\MIcd101;

/**
 * MIcd10HealthMedController implements the CRUD actions for MIcd10HealthMed model.
 */
class MIcd10HealthMedController extends Controller {

    protected function exec_hosxp_pcu($sql = null) {
        return \Yii::$app->db2->createCommand($sql)->execute();
    }

    /*
      public function behaviors()
      {
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

    /**
     * Lists all MIcd10HealthMed models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MIcd10HealthMedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MIcd10HealthMed model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*
      public function actionView($id)
      {
      return $this->render('view', [
      'model' => $this->findModel($id),
      ]);
      }
     */
    /**
     * Creates a new MIcd10HealthMed model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
      public function actionCreate()
      {
      $model = new MIcd10HealthMed();

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->icd10]);
      }

      return $this->render('create', [
      'model' => $model,
      ]);
      } */

    /**
     * Updates an existing MIcd10HealthMed model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelsicd = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) &&
                $modelsicd->load(Yii::$app->request->post()) && Model::validateMultiple([$model, $modelsicd])
        ) {

            $req = \Yii::$app->request;  //ประกาศตัวแปร
            $post = $req->post();

            //ส่งค่าจาก model ให้ตัวแปร
            $icd10 = $post['MIcd10HealthMed'] ['icd10'];
            $name = $post['MIcd10HealthMed'] ['name'];



      
            $sql = "REPLACE INTO icd10_health_med(icd10,name,hos_guid,hos_guid_ext)
                    VALUE('$icd10','$name','$hos_guid','$hos_guid_ext')";
            $this->exec_hosxp_pcu($sql);

            $sql2 = "REPLACE INTO icd101(code,name,spclty,tname,code3,code4,code5,sex,ipd_valid,icd10compat,icd10tmcompat,active_status) VALUES  
                     ('$code2','$name2','$spclty2','$tname2','$code32','$code42','$code52','$sex2','$ipd_valid2','$icd10compat2','$icd10tmcompat2','$active_status')";
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
                $log->code_data = $icd10;
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

    /**
     * Deletes an existing MIcd10HealthMed model.
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
     * Finds the MIcd10HealthMed model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MIcd10HealthMed the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MIcd10HealthMed::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
