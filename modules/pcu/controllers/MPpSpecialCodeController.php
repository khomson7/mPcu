<?php

namespace app\modules\pcu\controllers;

use Yii;
use app\modules\pcu\models\MPpSpecialCode;
use app\modules\pcu\models\MPpSpecialCodeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\pcu\models\Opdconfig;
use app\modules\pcu\models\ReportLog;
/**
 * MPpSpecialCodeController implements the CRUD actions for MPpSpecialCode model.
 */
class MPpSpecialCodeController extends Controller {

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
     * Lists all MPpSpecialCode models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MPpSpecialCodeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MPpSpecialCode model.
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
     * Creates a new MPpSpecialCode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
      public function actionCreate()
      {
      $model = new MPpSpecialCode();

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->code]);
      }

      return $this->render('create', [
      'model' => $model,
      ]);
      }
     */

    /**
     * Updates an existing MPpSpecialCode model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $req = \Yii::$app->request;  //ประกาศตัวแปร
            $post = $req->post();
             
            //ส่งค่าจาก model ให้ตัวแปร
            $code = $post['MPpSpecialCode'] ['code'];
            $name = $post['MPpSpecialCode'] ['name'];
            $pp_special_code_group = $post['MPpSpecialCode'] ['pp_special_code_group'];
            $pp_special_code_subgroup = $post['MPpSpecialCode'] ['pp_special_code_subgroup'];


            $sql = "REPLACE INTO pp_special_code(code,name,pp_special_code_group,pp_special_code_subgroup)
                    VALUE('$code','$name','$pp_special_code_group','$pp_special_code_subgroup')";
            $this->exec_hosxp_pcu($sql);

            if (\Yii::$app->request->isPost) {

                $opd = Opdconfig::find()
                        ->one();
                $opdconfig = $opd->hospitalcode;

                $model = \app\modules\pcu\models\PpSpecialCode::find()->select('code')
                        ->all();

                $query = MPpSpecialCode::find()
                        ->where(['NOT IN', 'code', $model])
                        ->count();

                $id = '7';
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
        ]);
    }

    /**
     * Deletes an existing MPpSpecialCode model.
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
     * Finds the MPpSpecialCode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MPpSpecialCode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MPpSpecialCode::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
