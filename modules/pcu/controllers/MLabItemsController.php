<?php

namespace app\modules\pcu\controllers;

use Yii;
use app\modules\pcu\models\MLabItems;
use app\modules\pcu\models\MLabItemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\pcu\models\ReportLog;
use app\modules\pcu\models\CountDataPcu;
use app\modules\pcu\models\Opdconfig;
use app\config\components\AppController;

/**
 * MLabItemsController implements the CRUD actions for MLabItems model.
 */
class MLabItemsController extends AppController {

    protected function exec_pcu_master($sql = NULL) {
        return \Yii::$app->db->createCommand($sql)->execute();
    }

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

    public function actionIndex() {
        $searchModel = new MLabItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndeximport() {
        $searchModel = new \app\modules\pcu\models\MLabImportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indeximport', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexproviscode() {
        $searchModel = new \app\modules\pcu\models\MLabProviscodeSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexproviscode', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MLabItems model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MLabItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
      public function actionCreate()
      {
      $model = new MLabItems();

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->lab_items_code]);
      }

      return $this->render('create', [
      'model' => $model,
      ]);
      }

     */

    /**
     * Updates an existing MLabItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*
      public function actionUpdate($id)
      {
      $model = $this->findModel($id);

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->lab_items_code]);
      }

      return $this->render('update', [
      'model' => $model,
      ]);
      }

     */


    public function actionUpdateimport($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $req = \Yii::$app->request;
            $post = $req->post();


            $lab_items_code = $post['MLabItems'] ['lab_items_code'];
            $lab_items_name = $post['MLabItems'] ['lab_items_name'];
            $lab_type_code = $post['MLabItems'] ['lab_type_code'];
            $lab_items_unit = $post['MLabItems'] ['lab_items_unit'];
            $lab_items_normal_value = $post['MLabItems'] ['lab_items_normal_value'];
            $lab_items_hint = $post['MLabItems'] ['lab_items_hint'];
            $lab_items_default_value = $post['MLabItems'] ['lab_items_default_value'];
            $lab_items_group = $post['MLabItems'] ['lab_items_group'];
            $service_price = $post['MLabItems'] ['service_price'];
            $possible_value = $post['MLabItems'] ['possible_value'];
            $lab_routine = $post['MLabItems'] ['lab_routine'];
            $icode = $post['MLabItems'] ['icode'];
            $lab_items_sub_group_code = $post['MLabItems'] ['lab_items_sub_group_code'];
            $require_specimen = $post['MLabItems'] ['require_specimen'];
            $specimen_code = $post['MLabItems'] ['specimen_code'];
            $wait_hour = $post['MLabItems'] ['wait_hour'];
            $critical_value = $post['MLabItems'] ['critical_value'];
            $display_order = $post['MLabItems'] ['display_order'];
            $ecode = $post['MLabItems'] ['ecode'];
            $service_price2 = $post['MLabItems'] ['service_price2'];
            $service_price3 = $post['MLabItems'] ['service_price3'];
            $service_price_ipd = $post['MLabItems'] ['service_price_ipd'];
            $service_price_ipd2 = $post['MLabItems'] ['service_price_ipd2'];
            $service_price_ipd3 = $post['MLabItems'] ['service_price_ipd3'];
            $check_user = $post['MLabItems'] ['check_user'];
            $sub_group_list = $post['MLabItems'] ['sub_group_list'];
            $range_check = $post['MLabItems'] ['range_check'];
            $range_check_min = $post['MLabItems'] ['range_check_min'];
            $range_check_max = $post['MLabItems'] ['range_check_max'];
            $result_type = $post['MLabItems'] ['result_type'];
            $range_check_min_female = $post['MLabItems'] ['range_check_min_female'];
            $range_check_max_female = $post['MLabItems'] ['range_check_max_female'];
            $lab_items_code_guid = $post['MLabItems'] ['lab_items_code_guid'];
            $service_cost = $post['MLabItems'] ['service_cost'];
            $oldcode = $post['MLabItems'] ['oldcode'];
            $items_is_outlab = $post['MLabItems'] ['items_is_outlab'];
            $hos_guid = $post['MLabItems'] ['hos_guid'];
            $report_edit_style = $post['MLabItems'] ['report_edit_style'];
            $memo_line_count = $post['MLabItems'] ['memo_line_count'];
            $alert_critical_value = $post['MLabItems'] ['alert_critical_value'];
            $critical_range_min_male = $post['MLabItems'] ['critical_range_min_male'];
            $critical_range_min_female = $post['MLabItems'] ['critical_range_min_female'];
            $critical_range_max_male = $post['MLabItems'] ['critical_range_max_male'];
            $critical_range_max_female = $post['MLabItems'] ['critical_range_max_female'];
            $confirm_order_text = $post['MLabItems'] ['confirm_order_text'];
            $loinc_code = $post['MLabItems'] ['loinc_code'];
            $check_result_by_age = $post['MLabItems'] ['check_result_by_age'];
            $check_history = $post['MLabItems'] ['check_history'];
            $check_history_day = $post['MLabItems'] ['check_history_day'];
            $lab_items_display_name = $post['MLabItems'] ['lab_items_display_name'];
            $hint_text = $post['MLabItems'] ['hint_text'];
            $lab_critical_alert_type_id = $post['MLabItems'] ['lab_critical_alert_type_id'];
            $active_status = $post['MLabItems'] ['active_status'];
            $protect_result_by_user = $post['MLabItems'] ['protect_result_by_user'];
            $protect_result_by_group = $post['MLabItems'] ['protect_result_by_group'];
            $explicit_show_hist_abn_value = $post['MLabItems'] ['explicit_show_hist_abn_value'];
            $provis_labcode = $post['MLabItems'] ['provis_labcode'];
            $alert_critical_value2 = $post['MLabItems'] ['alert_critical_value2'];
            $critical_range_min_male2 = $post['MLabItems'] ['critical_range_min_male2'];
            $critical_range_min_female2 = $post['MLabItems'] ['critical_range_min_female2'];
            $critical_range_max_male2 = $post['MLabItems'] ['critical_range_max_male2'];
            $critical_range_max_female2 = $post['MLabItems'] ['critical_range_max_female2'];
            $gen_order_no = $post['MLabItems'] ['gen_order_no'];
            $gen_order_prefix = $post['MLabItems'] ['gen_order_prefix'];

             $sql = "REPLACE INTO lab_items(lab_items_code,lab_items_name,lab_type_code,lab_items_unit,lab_items_normal_value,lab_items_hint,lab_items_default_value,lab_items_group,
service_price,possible_value,lab_routine,icode,lab_items_sub_group_code,require_specimen,specimen_code,wait_hour,critical_value,display_order,
ecode,service_price2,service_price3,service_price_ipd,service_price_ipd2,service_price_ipd3,check_user,sub_group_list,range_check,range_check_min,
range_check_max,result_type,range_check_min_female,range_check_max_female,lab_items_code_guid,service_cost,oldcode,items_is_outlab,hos_guid,report_edit_style,
memo_line_count,alert_critical_value,critical_range_min_male,critical_range_min_female,critical_range_max_male,critical_range_max_female,confirm_order_text,
loinc_code,check_result_by_age,check_history,check_history_day,lab_items_display_name,hint_text,lab_critical_alert_type_id,active_status,
protect_result_by_user,protect_result_by_group,explicit_show_hist_abn_value,provis_labcode,alert_critical_value2,critical_range_min_male2,
critical_range_min_female2,critical_range_max_male2,critical_range_max_female2,gen_order_no,gen_order_prefix)
                    VALUE('$lab_items_code','$lab_items_name','$lab_type_code','$lab_items_unit','$lab_items_normal_value','$lab_items_hint','$lab_items_default_value','$lab_items_group',
'$service_price','$possible_value','$lab_routine','$icode','$lab_items_sub_group_code','$require_specimen','$specimen_code','$wait_hour','$critical_value','$display_order',
'$ecode','$service_price2','$service_price3','$service_price_ipd','$service_price_ipd2','$service_price_ipd3','$check_user','$sub_group_list','$range_check','$range_check_min',
'$range_check_max','$result_type','$range_check_min_female','$range_check_max_female','$lab_items_code_guid','$service_cost','$oldcode','$items_is_outlab','$hos_guid','$report_edit_style',
'$memo_line_count','$alert_critical_value','$critical_range_min_male','$critical_range_min_female','$critical_range_max_male','$critical_range_max_female','$confirm_order_text',
'$loinc_code','$check_result_by_age','$check_history','$check_history_day','$lab_items_display_name','$hint_text','$lab_critical_alert_type_id','$active_status',
'$protect_result_by_user','$protect_result_by_group','$explicit_show_hist_abn_value','$provis_labcode','$alert_critical_value2','$critical_range_min_male2',
'$critical_range_min_female2','$critical_range_max_male2','$critical_range_max_female2','$gen_order_no','$gen_order_prefix')";
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
                $id = '5';
                $log = new ReportLog();
                $log->code_data = $lab_items_code;
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

            return $this->redirect(['indeximport']);
        }

        return $this->renderAjax('updateimport', [
                    'model' => $model,
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $req = \Yii::$app->request;
            $post = $req->post();

            $lab_items_code = $post['MLabItems'] ['lab_items_code'];
            $lab_items_name = $post['MLabItems'] ['lab_items_name'];

            $provis_labcode = $post['MLabItems'] ['provis_labcode'];


            $sql = "update lab_items set provis_labcode = '$provis_labcode' where lab_items_code = '$lab_items_code'";
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
                $id = '4';
                $log = new ReportLog();
                $log->code_data = $lab_items_code;
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

            return $this->redirect(['indexproviscode']);
        }

        return $this->renderAjax('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MLabItems model.
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
     * Finds the MLabItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MLabItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MLabItems::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
