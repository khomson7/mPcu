<?php

namespace app\modules\pcu\models;

use Yii;
use app\modules\pcu\models\TblToken;
use app\modules\pcu\models\TblTokenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TblTokenController implements the CRUD actions for TblToken model.
 */
class TblTokenController extends Controller
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
     * Lists all TblToken models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblTokenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblToken model.
     * @param integer $id
     * @param string $token_
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $token_)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $token_),
        ]);
    }

    /**
     * Creates a new TblToken model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblToken();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'token_' => $model->token_]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TblToken model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param string $token_
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $token_)
    {
        $model = $this->findModel($id, $token_);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'token_' => $model->token_]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TblToken model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param string $token_
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $token_)
    {
        $this->findModel($id, $token_)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblToken model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param string $token_
     * @return TblToken the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $token_)
    {
        if (($model = TblToken::findOne(['id' => $id, 'token_' => $token_])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
