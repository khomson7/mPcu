<?php

namespace app\modules\pcu\controllers;

use Yii;
use app\modules\pcu\models\MEpiVaccine;
use app\modules\pcu\models\MEpiVaccineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\pcu\models\Opdconfig;
use app\modules\pcu\models\PersonVaccine;
use app\config\components\AppController;
use app\modules\pcu\models\ReportLog;

/**
 * MEpiVaccineController implements the CRUD actions for MEpiVaccine model.
 */
class MEpiVaccineController extends AppController {

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
     * Lists all MEpiVaccine models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MEpiVaccineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MEpiVaccine model.
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
     * Creates a new MEpiVaccine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
      public function actionCreate()
      {
      $model = new MEpiVaccine();

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->epi_vaccine_id]);
      }

      return $this->render('create', [
      'model' => $model,
      ]);
      } */

    /**
     * Updates an existing MEpiVaccine model.
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

            $query = \app\modules\pcu\models\EpiVaccine::find()
                    ->orderBy(['epi_vaccine_id' => SORT_DESC])
                    ->one();
            
            $query1 = $query->epi_vaccine_id;
           

            $epi_vaccine_id = $query1 + 1;

            //   $epi_vaccine_id = $post['MEpiVaccine'] ['epi_vaccine_id'];
            $epi_vaccine_name = $post['MEpiVaccine'] ['epi_vaccine_name'];
            $vaccine_code = $post['MEpiVaccine'] ['vaccine_code'];
            $age_min = $post['MEpiVaccine'] ['age_min'];
            $age_max = $post['MEpiVaccine'] ['age_max'];
            $export_vaccine_code = $post['MEpiVaccine'] ['export_vaccine_code'];
            $vaccine_in_use = $post['MEpiVaccine'] ['vaccine_in_use'];
            $hos_guid = $null;
            $icode = $null;
            $price = $null;
            $combine_vaccine = $post['MEpiVaccine'] ['combine_vaccine'];
            $check_code = $post['MEpiVaccine'] ['check_code'];


            $sql = "REPLACE INTO epi_vaccine(epi_vaccine_id,epi_vaccine_name,vaccine_code,age_min,age_max,export_vaccine_code,vaccine_in_use,hos_guid,icode,price,combine_vaccine,check_code)
                    VALUE('$epi_vaccine_id','$epi_vaccine_name','$vaccine_code','$age_min','$age_max','$export_vaccine_code','$vaccine_in_use','$hos_guid','$icode','$price','$combine_vaccine','$check_code')";
            $this->exec_hosxp_pcu($sql);

            if (\Yii::$app->request->isPost) {

                $opd = Opdconfig::find()
                        ->one();
                $opdconfig = $opd->hospitalcode;

                $model = \app\modules\pcu\models\EpiVaccine::find()->select('vaccine_code')
                        ->all();

                $query = MEpiVaccine::find()
                        ->where(['NOT IN', 'vaccine_code', $model])
                        ->count();

                $id = '10';
                $log = new ReportLog();
                $log->code_data = $vaccine_code;
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
     * Deletes an existing MEpiVaccine model.
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
     * Finds the MEpiVaccine model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MEpiVaccine the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MEpiVaccine::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
