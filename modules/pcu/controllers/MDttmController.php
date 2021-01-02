<?php

namespace app\modules\pcu\controllers;

use Yii;
use app\modules\pcu\models\MDttm;
use app\modules\pcu\models\MDttmSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\pcu\models\ReportLog;
use app\modules\pcu\models\CountDataPcu;
use app\modules\pcu\models\Opdconfig;
use app\config\components\AppController;

/**
 * MDttmController implements the CRUD actions for MDttm model.
 */
class MDttmController extends Controller {

   protected function exec_hosxp_pcu($sql = NULL) {
        return \Yii::$app->db2->createCommand($sql)->execute();
    }

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
     * Lists all MDttm models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MDttmSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MDttm model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MDttm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new MDttm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->code]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing MDttm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $req = \Yii::$app->request;
            $post = $req->post();


            $code = $post['MDttm'] ['code'];
            $name = $post['MDttm'] ['name'];
            $requiredtc = $post['MDttm'] ['requiredtc'];
            $vorder = $post['MDttm'] ['vorder'];
            $treatment = $post['MDttm'] ['treatment'];
            $icd10 = $post['MDttm'] ['icd10'];
            $icd9cm = $post['MDttm'] ['icd9cm'];
            $icode = $post['MDttm'] ['icode'];
            $opd_price1 = $post['MDttm'] ['opd_price1'];
            $opd_price2 = $post['MDttm'] ['opd_price2'];
            $opd_price3 = $post['MDttm'] ['opd_price3'];
            $ipd_price1 = $post['MDttm'] ['ipd_price1'];
            $ipd_price2 = $post['MDttm'] ['ipd_price2'];
            $ipd_price3 = $post['MDttm'] ['ipd_price3'];
            $dttm_group_id = $post['MDttm'] ['dttm_group_id'];
            $unit = $post['MDttm'] ['unit'];
            $charge_per_qty = $post['MDttm'] ['charge_per_qty'];
            $active_status = $post['MDttm'] ['active_status'];
            $dttm_guid = $post['MDttm'] ['dttm_guid'];
            $thai_name = $post['MDttm'] ['thai_name'];
            $charge_area_qty = $post['MDttm'] ['charge_area_qty'];
            $dttm_subgroup_id = $post['MDttm'] ['dttm_subgroup_id'];
            $icd10tm_operation_code = $post['MDttm'] ['icd10tm_operation_code'];
            $dttm_dw_report_group_id = $post['MDttm'] ['dttm_dw_report_group_id'];
            $export_proced = $post['MDttm'] ['export_proced'];
            $dent2006_item_code = $post['MDttm'] ['dent2006_item_code'];
            $hos_guid = $post['MDttm'] ['hos_guid'];

            $sql = "REPLACE INTO dttm(code,name,requiredtc,vorder,treatment,icd10,icd9cm,icode,opd_price1,opd_price2,opd_price3,
ipd_price1,ipd_price2,ipd_price3,dttm_group_id,unit,charge_per_qty,active_status,
thai_name,charge_area_qty,dttm_subgroup_id,icd10tm_operation_code,dttm_dw_report_group_id,
export_proced,dent2006_item_code)
                    VALUE('$code','$name','$requiredtc','$vorder','$treatment','$icd10','$icd9cm','$icode','$opd_price1','$opd_price2','$opd_price3'
,'$ipd_price1','$ipd_price2','$ipd_price3','$dttm_group_id','$unit','$charge_per_qty','$active_status',
'$thai_name','$charge_area_qty','$dttm_subgroup_id','$icd10tm_operation_code','$dttm_dw_report_group_id'
,'$export_proced','$dent2006_item_code')";
            $this->exec_hosxp_pcu($sql);



            if (\Yii::$app->request->isPost) {
                /*
                  $opd = Opdconfig::find()
                  ->one();
                  $opdconfig = $opd->hospitalcode;

                  $model = ProvisVcctype::find()->select('code')
                  ->all();

                  $query = MProvisVcctype::find()
                  ->where(['NOT IN', 'code', $model])
                  ->count();
                 */
                $id = '6';
                $log = new ReportLog();
                $log->code_data = $code;
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

    /**
     * Deletes an existing MDttm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MDttm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MDttm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MDttm::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
