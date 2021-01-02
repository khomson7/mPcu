<?php

namespace app\controllers;

use Yii;
use app\models\RcptArrear;
use app\models\RcptArrearSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RcptArrearController implements the CRUD actions for RcptArrear model.
 */
class RcptArrearController extends Controller {

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
     * Lists all RcptArrear models.
     * @return mixed
     */
    protected function exec_sql_hosreport($sql = NULL) {
        return \Yii::$app->db->createCommand($sql)->execute();
    }

    protected function exec_sql_hos($sql = NULL) {
        return \Yii::$app->db2->createCommand($sql)->execute();
    }

    public function actionIndex() {
        $searchModel = new RcptArrearSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RcptArrear model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
   /* public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }
*/
    
    
    public function actionView($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => (string) $model->_id]);
        }elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                        'model' => $model
            ]);
        } else {
            return $this->renderAjax('view', [
                        'model' => $model
            ]);
        }
    }
    /**
     * Creates a new RcptArrear model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
      public function actionCreate()
      {
      $model = new RcptArrear();

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->arrear_id]);
      }

      return $this->render('create', [
      'model' => $model,
      ]);
      }
     */

    /**
     * Updates an existing RcptArrear model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate1($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->arrear_id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    public function actionUpdate($id) {
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $req = \Yii::$app->request;
            $post = $req->post();


            $arrear_id = $post['RcptArrear']['arrear_id'];
            $vn = $post['RcptArrear']['vn'];
            $arrear_date = $post['RcptArrear']['arrear_date'];
            $arrear_time = $post['RcptArrear']['arrear_time'];
            $amount = $post['RcptArrear']['amount'];
            $staff = $post['RcptArrear']['staff'];
            $rcpno = $post['RcptArrear']['rcpno'];
            $finance_number = $post['RcptArrear']['finance_number'];
            $paid = $post['RcptArrear']['paid'];
            $pt_type = $post['RcptArrear']['pt_type'];
            $hn = $post['RcptArrear']['hn'];
            $receive_money_date = $post['RcptArrear']['receive_money_date'];
            $receive_money_time = $post['RcptArrear']['receive_money_time'];
            $receive_money_staff = $post['RcptArrear']['receive_money_staff'];
            $hos_guid = $post['RcptArrear']['hos_guid'];
            $an = $post['RcptArrear']['an'];
            $user_id =   Yii::$app->user->getId(); 
            $d_update = (new \DateTime())->format('Y-m-d H:i:s');

            $sql = " REPLACE INTO base_rcpt_arrear (arrear_id, vn, arrear_date, arrear_time, amount, staff, rcpno, finance_number
                , paid, pt_type, hn, receive_money_date, receive_money_time, receive_money_staff, hos_guid, an, user_id,d_update) VALUES  
                     ('$arrear_id','$vn' ,'$arrear_date','$arrear_time', '$amount', '$staff', '$rcpno', '$finance_number'
                    , '$paid', '$pt_type', '$hn', '$receive_money_date', '$receive_money_time', '$receive_money_staff'
             , '$hos_guid', '$an','$user_id','$d_update') ";
            $this->exec_sql_hosreport($sql);
           
            
              $sql = "DELETE FROM rcpt_arrear WHERE vn ='$vn'";
              $this->exec_sql_hos($sql);
            
              
            return $this->redirect(['index', 'id' => $vn]);
        } else {
            return $this->renderAjax('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RcptArrear model.
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
     * Finds the RcptArrear model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RcptArrear the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = RcptArrear::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
