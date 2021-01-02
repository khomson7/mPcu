<?php

namespace app\modules\pcu\controllers;

use Yii;
use app\modules\pcu\models\MWbcVaccine;
use app\modules\pcu\models\MWbcVaccineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\pcu\models\Opdconfig;
use app\modules\pcu\models\PersonVaccine;
use app\config\components\AppController;
use app\modules\pcu\models\ReportLog;

/**
 * MWbcVaccineController implements the CRUD actions for MWbcVaccine model.
 */
class MWbcVaccineController extends AppController {

    /**
     * {@inheritdoc}
     */
    protected function exec_pcu_master($sql = NULL) {
        return \Yii::$app->db->createCommand($sql)->execute();
    }

    protected function exec_hosxp_pcu($sql = NULL) {
        return \Yii::$app->db2->createCommand($sql)->execute();
    }

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

    /**
     * Lists all MWbcVaccine models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MWbcVaccineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MWbcVaccine model.
     * @param integer $id
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
     * Creates a new MWbcVaccine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
      public function actionCreate()
      {
      $model = new MWbcVaccine();

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->wbc_vaccine_id]);
      }

      return $this->render('create', [
      'model' => $model,
      ]);
      }
     */

    /**
     * Updates an existing MWbcVaccine model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $req = \Yii::$app->request;  //ประกาศตัวแปร
            $post = $req->post();

            //ส่งค่าจาก model ให้ตัวแปร
            $null = null;
            
            $query = \app\modules\pcu\models\WbcVaccine::find()
                        ->orderBy(['wbc_vaccine_id' => SORT_DESC])
                    ->one();
            
            $query1 = $query->wbc_vaccine_id;
            $wbc_vaccine_id = $query1+1;
            
           // $wbc_vaccine_id = $post['MWbcVaccine'] ['wbc_vaccine_id'];
            $wbc_vaccine_name = $post['MWbcVaccine'] ['wbc_vaccine_name'];
            $wbc_vaccine_code = $post['MWbcVaccine'] ['wbc_vaccine_code'];
            $age_min = $post['MWbcVaccine'] ['age_min'];
            $age_max = $post['MWbcVaccine'] ['age_max'];
            $export_vaccine_code = $post['MWbcVaccine'] ['export_vaccine_code'];
            $check_code = $post['MWbcVaccine'] ['check_code'];
            $vaccine_in_use = $post['MWbcVaccine'] ['vaccine_in_use'];
            $hos_guid = $null;
            $icode = $null;
            $price = $null;
            $combine_vaccine = $post['MWbcVaccine'] ['combine_vaccine'];


            $sql = "REPLACE INTO wbc_vaccine(wbc_vaccine_id,wbc_vaccine_name,wbc_vaccine_code,age_min,age_max,export_vaccine_code,check_code,vaccine_in_use,hos_guid,icode,price,combine_vaccine)
                    VALUE('$wbc_vaccine_id','$wbc_vaccine_name','$wbc_vaccine_code','$age_min','$age_max','$export_vaccine_code','$check_code','$vaccine_in_use','$hos_guid','$icode','$price','$combine_vaccine')";
            $this->exec_hosxp_pcu($sql);

            if (\Yii::$app->request->isPost) {

                $opd = Opdconfig::find()
                        ->one();
                $opdconfig = $opd->hospitalcode;

                $model = \app\modules\pcu\models\WbcVaccine::find()->select('wbc_vaccine_code')
                        ->all();

                $query = MWbcVaccine::find()
                        ->where(['NOT IN', 'wbc_vaccine_code', $model])
                        ->count();

                $id = '9';
                $log = new ReportLog();
                $log->code_data = $wbc_vaccine_code;
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
        ]);
    }

    /**
     * Deletes an existing MWbcVaccine model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
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
     * Finds the MWbcVaccine model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MWbcVaccine the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MWbcVaccine::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
