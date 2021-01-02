<?php

namespace app\modules\pcu\controllers;

use Yii;
use app\modules\pcu\models\ProvisVcctype;
use app\modules\pcu\models\MProvisVcctype;
use app\modules\pcu\models\MProvisVcctypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\config\components\AppController;
use app\modules\pcu\models\ReportLog;
use app\modules\pcu\models\CountDataPcu;
use app\modules\pcu\models\Opdconfig;

/**
 * MProvisVcctypeController implements the CRUD actions for MProvisVcctype model.
 */
class MProvisVcctypeController extends AppController {

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
     * Lists all MProvisVcctype models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MProvisVcctypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MProvisVcctype model.
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
     * Creates a new MProvisVcctype model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new MProvisVcctype();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->code]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing MProvisVcctype model.
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

            $code = $post['MProvisVcctype'] ['code'];
            $name = $post['MProvisVcctype'] ['name'];

            $sql = "REPLACE INTO provis_vcctype(code,name)
                    VALUE('$code','$name')";
            $this->exec_hosxp_pcu($sql);

            if (\Yii::$app->request->isPost) {

                $opd = Opdconfig::find()
                        ->one();
                $opdconfig = $opd->hospitalcode;

                $model = ProvisVcctype::find()->select('code')
                        ->all();

                $query = MProvisVcctype::find()
                        ->where(['NOT IN', 'code', $model])
                        ->count();

                $id = '2';
                $log = new ReportLog();
                $log->code_data = $code;
                $log->user_id = \Yii::$app->user->identity->id;
                $log->datetime = date('Y-m-d H:i:s');
                $log->data_index_id = $id;
                $log->ip = \Yii::$app->request->getUserIP();
                $log->save();

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
            }

            return $this->redirect(['index']);
        }

        return $this->renderAjax('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MProvisVcctype model.
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
     * Finds the MProvisVcctype model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return MProvisVcctype the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MProvisVcctype::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
