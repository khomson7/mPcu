<?php

namespace app\modules\pcu\controllers;

use Yii;
use app\modules\pcu\models\MPpSpecialType;
use app\modules\pcu\models\MPpSpecialTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\pcu\models\Opdconfig;
use app\modules\pcu\models\ReportLog;

/**
 * MPpSpecialTypeController implements the CRUD actions for MPpSpecialType model.
 */
class MPpSpecialTypeController extends Controller {

    protected function exec_hosxp_pcu($sql = null) {
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
     * Lists all MPpSpecialType models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MPpSpecialTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MPpSpecialType model.
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
     * Creates a new MPpSpecialType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
      public function actionCreate()
      {
      $model = new MPpSpecialType();

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->pp_special_type_id]);
      }

      return $this->render('create', [
      'model' => $model,
      ]);
      }
     * */

    /**
     * Updates an existing MPpSpecialType model.
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
            $pp_special_type_id = $post['MPpSpecialType'] ['pp_special_type_id'];
            $pp_special_type_name = $post['MPpSpecialType'] ['pp_special_type_name'];
         //   $hos_guid = $post['MPpSpecialCode'] ['hos_guid'];
            $pp_special_code = $post['MPpSpecialType'] ['pp_special_code'];


            $sql = "REPLACE INTO pp_special_type(pp_special_type_id,pp_special_type_name,pp_special_code)
                    VALUE('$pp_special_type_id','$pp_special_type_name','$pp_special_code')";
            $this->exec_hosxp_pcu($sql);

            if (\Yii::$app->request->isPost) {

                $opd = Opdconfig::find()
                        ->one();
                $opdconfig = $opd->hospitalcode;

                $model = \app\modules\pcu\models\PpSpecialType::find()->select('pp_special_type_id')
                        ->all();

                $query = MPpSpecialType::find()
                        ->where(['NOT IN', 'pp_special_type_id', $model])
                        ->count();

                $id = '8';
                $log = new ReportLog();
                $log->code_data = $pp_special_type_id;
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
     * Deletes an existing MPpSpecialType model.
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
      } */

    /**
     * Finds the MPpSpecialType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MPpSpecialType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MPpSpecialType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
