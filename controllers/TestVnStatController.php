<?php

namespace app\controllers;

use Yii;
use app\models\TestVnStat;
use app\models\TestVnStatSearch;
use yii\web\Controller;
use common\components;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;

/**
 * TestVnStatController implements the CRUD actions for TestVnStat model.
 */
class TestVnStatController extends Controller {

    public $enableCsrfValidation = false; //เพิ่ม

    /**
     * {@inheritdoc}
     */
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
     * 
     */

    /*
      protected function exec_sql_hosreport($sql = NULL) {
      return \Yii::$app->db->createCommand($sql)->execute();
      }
     */

    protected function exec_sql_hos2($sql = NULL) {
        return \Yii::$app->db2->createCommand($sql)->execute();
    }

    /**
     * Lists all TestVnStat models.
     * @return mixed
     */
    public function actionIndex() {

        $connection = Yii::$app->db2;

        $vn = '';
        $vstdate = '1';
        $pttype = '';
        $hn = '';



        if (Yii::$app->request->isPost) {
            $vn = Yii::$app->request->post('vn');
            Yii::$app->session['vn'] = $vn;
        }

        if (isset($_GET['vn'])) {
            $vn = Yii::$app->session['vn'];
            $vn = $_GET['vn'];
        }

        if (isset($_GET['page'])) {
            $vn = Yii::$app->session['vn'];
        }

        // ข้อมูลบุคคล
        $sql = "select * from vn_stat where vn = '$vn' limit 1";

        $data = $connection->createCommand($sql)
                ->queryAll();

        for ($i = 0; $i < sizeof($data); $i++) {
            $vn = $data[$i]['vn'];
            $hn = $data[$i]['hn'];
            $pttype = $data[$i]['pttype'];
            $vstdate = $data[$i]['vstdate'];
        }






        // ข้อมูลวันที่มารักษา
        $sqld = "select * from vn_stat where vn = '$vn' ";

        $rawData = $connection->createCommand($sqld)
                ->queryAll();



        $dataProvider = new ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 10
            ],
        ]);

        return $this->render('index', ['vn' => $vn, 'hn' => $hn, 'pttype' => $pttype,
                    'vstdate' => $vstdate,
                    'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single TestVnStat model.
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
     * Creates a new TestVnStat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    /**
     * Updates an existing TestVnStat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $pcl  = new \app\models\PttypeChangeForm();

        if ($model->load(Yii::$app->request->post()) && $pcl->load(Yii::$app->request->post())) {
         
             if(!$model->save())throw new \yii\web\NotFoundHttpException('Model could not be save');


                 $req = \Yii::$app->request;
            $post = $req->post();
            $pttype_new = $post['PttypeChangeForm']['pttype_new'];
            $remark = $post['PttypeChangeForm']['remark'];
            $vn = $post['TestVnStat']['vn'];
            $hn = $post['TestVnStat']['hn'];
            $pttype = $post['TestVnStat']['pttype'];           
            $d_update = (new \DateTime())->format('Y-m-d H:i:s');
            $user_id =   Yii::$app->user->getId(); 
            
            $sql = " REPLACE INTO pttype_change_log ( vn,hn,pttype,pttype_new,user_id,remark,d_update) VALUES  
                     ('$vn' , '$hn','$pttype','$pttype_new','$user_id','$remark','$d_update') ";
            $this->exec_sql_hos2($sql);




            return $this->redirect(['index', 'id' => $vn]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'pcl' => $pcl,
            ]);
        }
    }

    public function actionUpdate1($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->vn]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TestVnStat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    /**
     * Finds the TestVnStat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TestVnStat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = TestVnStat::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
