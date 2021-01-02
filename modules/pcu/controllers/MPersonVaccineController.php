<?php

namespace app\modules\pcu\controllers;

use Yii;
use app\modules\pcu\models\MPersonVaccine;
use app\modules\pcu\models\MPersonVaccineSearch;
use app\modules\pcu\models\MPersonVaccineSearch2;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\config\components\AppController;
use app\modules\pcu\models\ReportLog;
use app\modules\pcu\models\CountDataPcu;
use app\modules\pcu\models\Opdconfig;
use app\modules\pcu\models\PersonVaccine;

/**
 * MPersonVaccineController implements the CRUD actions for MPersonVaccine model.
 */
class MPersonVaccineController extends AppController {

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
     * Lists all MPersonVaccine models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MPersonVaccineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
     public function actionIndex2() {
        $searchModel = new MPersonVaccineSearch2();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index2', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MPersonVaccine model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }
*/
    /**
     * Creates a new MPersonVaccine model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
    public function actionCreate() {
        $model = new MPersonVaccine();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->person_vaccine_id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }
*/
    /**
     * Updates an existing MPersonVaccine model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $req = \Yii::$app->request;
            $post = $req->post();

           // $person_vaccine_id1 = PersonVaccine::find()->select('person_vaccine_id')->orderBy('person_vaccine_id DESC')->limit(1)->one();
            $query = PersonVaccine::find()                  
                    ->orderBy(['person_vaccine_id' => SORT_DESC])
                ->one();
              $query1 = $query->person_vaccine_id;
            
            $person_vaccine_id = $query1+1;

            $vaccine_name = $post['MPersonVaccine'] ['vaccine_name'];
            $vaccine_code = $post['MPersonVaccine'] ['vaccine_code'];
            $vaccine_group = $post['MPersonVaccine'] ['vaccine_group'];
            $export_vaccine_code = $post['MPersonVaccine'] ['export_vaccine_code'];

            $sql = "REPLACE INTO person_vaccine(person_vaccine_id,vaccine_name,vaccine_code,vaccine_group,export_vaccine_code)
                    VALUE('$person_vaccine_id','$vaccine_name','$vaccine_code','$vaccine_group','$export_vaccine_code')";
            $this->exec_hosxp_pcu($sql);

            if (\Yii::$app->request->isPost) {

                $opd = Opdconfig::find()
                        ->one();
                $opdconfig = $opd->hospitalcode;

                $model = PersonVaccine::find()->select('export_vaccine_code')
                        ->all();

                $query = MPersonVaccine::find()
                        ->where(['NOT IN', 'export_vaccine_code', $model])
                        ->count();

                $id = '3';
                $log = new ReportLog();
                $log->code_data = $export_vaccine_code;
                $log->user_id = \Yii::$app->user->identity->id;
                $log->datetime = date('Y-m-d H:i:s');
                $log->data_index_id = $id;
                $log->ip = \Yii::$app->request->getUserIP();
                $log->save();

                $sql = "delete from count_data_pcu where hosp_code = '$opdconfig' and data_id = '$id'";
                $this->exec_pcu_master($sql);

                $idkey = $opdconfig . $id;
                $log = new CountDataPcu();
                $log->idkey = $idkey;
                $log->count_data = $query;
                $log->data_id = $id;
                $log->datetime = date('Y-m-d H:i:s');
                $log->hosp_code = $opdconfig;
                $log->ip = \Yii::$app->request->getUserIP();
                $log->save();
            }

            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
                    'model' => $model,
        ]);
    }
    
    
    public function actionUpdate2($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $req = \Yii::$app->request;
            $post = $req->post();

           // $person_vaccine_id1 = PersonVaccine::find()->select('person_vaccine_id')->orderBy('person_vaccine_id DESC')->limit(1)->one();
            $query1 = PersonVaccine::find()
                        ->count();
            $person_vaccine_id = $query1+1;

            $vaccine_name = $post['MPersonVaccine'] ['vaccine_name'];
            $vaccine_code = $post['MPersonVaccine'] ['vaccine_code'];
            $vaccine_group = $post['MPersonVaccine'] ['vaccine_group'];
            $export_vaccine_code = $post['MPersonVaccine'] ['export_vaccine_code'];

            $sql = "update person_vaccine set export_vaccine_code = '$export_vaccine_code',vaccine_group = '$vaccine_group'where vaccine_code = '$vaccine_code'";
            $this->exec_hosxp_pcu($sql);

            if (\Yii::$app->request->isPost) {

                $opd = Opdconfig::find()
                        ->one();
                $opdconfig = $opd->hospitalcode;

                $model = PersonVaccine::find()->select('export_vaccine_code')
                        ->all();

                $query = MPersonVaccine::find()
                        ->where(['NOT IN', 'export_vaccine_code', $model])
                        ->count();

                $id = '3';
                $log = new ReportLog();
                $log->code_data = $export_vaccine_code;
                $log->user_id = \Yii::$app->user->identity->id;
                $log->datetime = date('Y-m-d H:i:s');
                $log->data_index_id = $id;
                $log->ip = \Yii::$app->request->getUserIP();
                $log->save();

                $sql = "delete from count_data_pcu where hosp_code = '$opdconfig' and data_id = '$id'";
                $this->exec_pcu_master($sql);

                $idkey = $opdconfig . $id;
                $log = new CountDataPcu();
                $log->idkey = $idkey;
                $log->count_data = $query;
                $log->data_id = $id;
                $log->datetime = date('Y-m-d H:i:s');
                $log->hosp_code = $opdconfig;
                $log->ip = \Yii::$app->request->getUserIP();
                $log->save();
            }

            return $this->redirect(['index2']);
        }

        return $this->renderAjax('update2', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MPersonVaccine model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
*/
    /**
     * Finds the MPersonVaccine model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MPersonVaccine the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MPersonVaccine::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
