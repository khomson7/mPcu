<?php

namespace app\modules\pcu\controllers;

use Yii;
use app\modules\pcu\models\Person;
use app\modules\pcu\models\PersonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\pcureport\models\HosBasedata;
use app\modules\pcureport\models\HosBasedataSub;
use app\config\components\AppController;
use app\modules\pcu\models\ReportLog;
use app\modules\pcu\models\Opdconfig;

/**
 * PersonController implements the CRUD actions for Person model.
 */
class PersonController extends AppController {

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
     * Lists all Person models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PersonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionType1() {
        $searchModel = new \app\modules\pcu\models\PersonType1Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('type1', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionType2() {
        $searchModel = new \app\modules\pcu\models\PersonType2Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('type2', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionType3() {
        $searchModel = new \app\modules\pcu\models\PersonType3Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('type3', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionType4() {
        $searchModel = new \app\modules\pcu\models\PersonType4Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('type4', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTypex() {
        $searchModel = new \app\modules\pcu\models\PersonType1Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $sql = "select person_id,pname,fname,lname,concat(DATE_FORMAT(birthdate,'%d-%m-'),DATE_FORMAT(birthdate,'%Y')+543) as birthdate 
,concat(DATE_FORMAT(last_update,'%d-%m-'),DATE_FORMAT(last_update,'%Y')+543) as last_update
from person p WHERE p.house_regist_type_id = '1' AND person_discharge_id not in('1')
ORDER BY date(last_update) asc";


        $rawData = \Yii::$app->db2->createCommand($sql)->queryAll();
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;

        $sql = "select * from kpi_index_date WHERE id = '1'";
        $data = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($data as $data) {
            $b_date = $data['b_date'];
            $e_date = $data['e_date'];
            $file_name = $data['file_name'];
        }

        $id = '6';

        $sql = "select * FROM hos_basedata_sub WHERE id = '$id'";

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();

        foreach ($rawData as $data) {
            // $id = $data['id'];
            $base_data = $data['basedata_sub_name'];
        }
        $code = $opdconfig . 'basedata_sub:' . $data['id'];

        $log = new ReportLog();
        $log->code_data = $code;
        $log->user_id = \Yii::$app->user->identity->id;
        $log->datetime = date('Y-m-d H:i:s');
        // $log->data_index_id = $id;
        $log->ip = \Yii::$app->request->getUserIP();
        $log->save();

        return $this->render('type1', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
                        //  'date1' => $date1,
                        //  'date2' => $date2,
        ]);
    }

    /**
     * Displays a single Person model.
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
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Person();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->person_id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {


            $model->last_update = date('Y-m-d H:i:s');
            $model->save();
            return $this->redirect(['type1']);
        }

        return $this->renderAjax('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Person model.
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
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
