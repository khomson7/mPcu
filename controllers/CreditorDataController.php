<?php

namespace app\controllers;

use Yii;
use app\models\CreditorData;
use app\models\CreditorDataSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CreditorDataController implements the CRUD actions for CreditorData model.
 */
class CreditorDataController extends Controller {



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
    
        protected function exec_sql_hosreport($sql = NULL) {
        return \Yii::$app->db->createCommand($sql)->execute();
    }

    protected function exec_sql_hosreport2($sql = NULL) {
        return \Yii::$app->db->createCommand($sql)->execute();
    }

    /**
     * Lists all CreditorData models.
     * @return mixed
     */
    /*
      public function actionIndex()
      {
      $searchModel = new CreditorDataSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


      return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
      ]);
      }
     */

    public function actionIndex() {
        $searchModel = new CreditorDataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where('user_id = :user_id', [':user_id' => Yii::$app->user->getId()]);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CreditorData model.
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
     * Creates a new CreditorData model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new CreditorData();

        if ($model->load(Yii::$app->request->post())) {

            $model->user_id = \Yii::$app->user->identity->id;
            $model->d_update = date('Y-m-d H:i:s');
            $model->save();

            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing CreditorData model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $req = \Yii::$app->request;
            $post = $req->post();

            $creditor_data_id = $post['CreditorData']['id'];
            $user_id =   Yii::$app->user->getId(); 
            $d_update = (new \DateTime())->format('Y-m-d H:i:s');

            $sql = " REPLACE INTO creditor_data_update ( creditor_data_id,user_id,d_update) VALUES  
                     ('$creditor_data_id','$user_id','$d_update') ";
            $this->exec_sql_hosreport2($sql);
                                                    
            return $this->redirect(['index', 'id' => $id]);
        } else {
            return $this->renderAjax('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CreditorData model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CreditorData model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CreditorData the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = CreditorData::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
