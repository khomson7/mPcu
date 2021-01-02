<?php

namespace app\modules\pcu\controllers;

use Yii;
use app\modules\pcu\models\WscPcuOapp;
use app\modules\pcu\models\WscPcuOappSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\pcu\models\Opdconfig;

/**
 * WscPcuOappController implements the CRUD actions for WscPcuOapp model.
 */
class WscPcuOappController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * Lists all WscPcuOapp models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WscPcuOappSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WscPcuOapp model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($oaid)
    {
        return $this->render('view', [
            'model' => $this->findModel($oaid),
        ]);
    }

    /**
     * Creates a new WscPcuOapp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
    public function actionCreate()
    {
        $model = new WscPcuOapp();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    */
    public function actionCreate()
    {
        $model = new WscPcuOapp();
        $opd = Opdconfig::find()->one();
                

        if ($model->load(Yii::$app->request->post())) {
            $model->createdate = date('Y-m-d h:m:s');
            //$model->user_id = Yii::$app->user->identity->username;
              $model->user_id = Yii::$app->user->identity->id;
              $model->hospcode = $opd->hospitalcode;
              
            $model->save();
            //return $this->redirect(['index']);
            return $this->redirect(['/pcu/linesend/curloapp']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }
    
    

    /**
     * Updates an existing WscPcuOapp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($oaid)
    {
        $model = $this->findModel($oaid);
               $opd = Opdconfig::find()->one();
       if ($model->load(Yii::$app->request->post())) {
            $model->createdate = date('Y-m-d h:m:s');
            //$model->user_id = Yii::$app->user->identity->username;
              $model->user_id = Yii::$app->user->identity->id;
              $model->hospcode = $opd->hospitalcode;
              
            $model->save();
           // return $this->redirect(['index']);
            return $this->redirect(['/pcu/linesend/curloapp']);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing WscPcuOapp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($oaid)
    {
        $this->findModel($oaid)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WscPcuOapp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WscPcuOapp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($oaid)
    {
        if (($model = WscPcuOapp::findOne($oaid)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
