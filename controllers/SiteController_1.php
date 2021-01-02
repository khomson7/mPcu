<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\ArrayDataProvider;
use dosamigos\arrayquery\ArrayQuery;
use app\modules\pcu\models\Opdconfig;
use app\modules\pcu\models\PkByear;

class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    
  public function actionIndex2()
    {
        return $this->render('index2');
    }
            
    public function actionIndex($find = NULL) {

        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');
        if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
        }


        $byear = PkByear::find()
                // ->where('_check = :_check', [':_check' => $count])
                ->one();

        $opd = Opdconfig::find()
                ->one();
        $opdconfig = $opd->hospitalcode;
        $opdconfig2 = $opd->hospitalname;
        $keyid = $opdconfig . '1';
        $tyear = $byear->tyear;
        $person = 'ข้อมูลแฟ้มประชากร';

        $sql = "SELECT pd.all_target,pd.type1,pd.type2,pd.type3,pd.type4,(pd.type1+pd.type3) as type13,pd.edit_in_year,pd.hospcode,pt.tname
            ,concat(DATE_FORMAT(d_update,'%d/%m/'),DATE_FORMAT(d_update,'%Y')+543,DATE_FORMAT(d_update,' %H:%i:%s')) as  d_update
            ,pt.link1,pt.link2,pt.link3,pt.link4
                FROM person_target_detail pd 
                left join person_target_index pt on pt.id = pd.person_target_index_id
                  where idkey = '$keyid'  and pd.b_year = '$tyear'            
             ";
        $data = Yii::$app->db->createCommand($sql)->queryAll();

        //ส่งให้ตาราง
        foreach ($data as $d) {
            $type1 = [intval($d['type1'])];
            $type2 = [intval($d['type2'])];
            $type3 = [intval($d['type3'])];
            $type4 = [intval($d['type4'])];
            $type13 = [intval($d['type13'])];

            $type2text = $d['tname'];
        }


        $dataProvider1 = new ArrayDataProvider([
            'allModels' => $data,
            'sort' => [
                'attributes' => ['tname'],
            ]
        ]);



        $mainindex = 'เป็นข้อมูลที่ใช้ในการมอร์นิเตอร์เบื้องต้นเท่านั้น ผลงานจริงสามารถเข้าดูได้ที่ HDC';

        $sql = "select (select kpi_name from kpi_index_name where file = kpi_index_pcu.file_name ) as kpi_name,
            (select main_target from kpi_index_name where file = kpi_index_pcu.file_name ) as main_target,
 (select kt.kpi_type_name from kpi_type kt 
 left join kpi_index_name ki on kt.kpi_type_id = ki.kpi_type_id
where ki.file = file_name) as kpi_type_name
 ,kpi_index_pcu.*,concat(DATE_FORMAT(kpi_index_pcu.d_update,'%d/%m/'),DATE_FORMAT(kpi_index_pcu.d_update,'%Y')+543,DATE_FORMAT(kpi_index_pcu.d_update,' %H:%i:%s')) as td_update 
,(select hdc_link from kpi_index_date WHERE file_name = kpi_index_pcu.file_name) as hdc_link
,(select wait_for_link from kpi_index WHERE file_name = kpi_index_pcu.file_name) as wait_for_link2
,(select id_link from kpi_index WHERE file_name = kpi_index_pcu.file_name) as id_link2
FROM kpi_index_pcu  where hospcode = '$opdconfig'
order by (select id from kpi_index_name where file = kpi_index_pcu.file_name ) asc
";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        /* เพิ่มเข้ามาจากวันแรก */
        $query = new ArrayQuery($raw);
        $model = $query->find();
        if (!empty($find)) {
            $model = $query
                    ->addCondition("kpi_name", "like $find", "or")
                    ->addCondition("file_name", "like $find", "or")
                    ->addCondition("kpi_type_name", "like $find")
                    ->find();
        }

        /* เพิ่มเข้ามาจากวันแรก */

        if (!empty($raw[0])) {
            $cols = array_keys($raw[0]);
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $model, // เปลี่ยนเป็น model
            'sort' => !empty($cols) ? ['attributes' => $cols] : FALSE,
            'pagination' => [
                'pageSize' => 15
            ]
        ]);



        $data_api0 = file_get_contents('https://covid19.th-stat.com/api/open/timeline');
        $json_api0 = json_decode($data_api0, true);

        foreach ($json_api0['Data'] as $key => $value) {
            // $date = ['2020-01-01', '2020-01-02', '2020-01-03', '2020-01-03'];
            //   $NewConfirmed = ['18' * 1, '10' * 1, '20' * 1, '20' * 1];
            //  $NewRecovered = ['20' * 1, '21' * 1, '29' * 1, '20' * 1];
            $date[] = date($value['Date']);
            $Confirmed[] = [intval($value['Confirmed'])];
            // $NewConfirmed = $value['NewConfirmed'] * 1;
            $Recovered[] = [intval($value['Recovered'])];
            $Hospitalized[] = [intval($value['Hospitalized'])];
            $Deaths[] = [intval($value['Deaths'])];
        }


        return $this->render('index', [
                    'type1' => $type1,
                    'type2' => $type2,
                    'type3' => $type3,
                    'type4' => $type4,
                    'type13' => $type13,
                    'dataProvider' => $dataProvider,
                    'dataProvider1' => $dataProvider1,
                    // 'dataProvider3' => $dataProvider3, 
                    'find' => $find,
                    'mainindex' => $mainindex,
                    'date1' => $date1,
                    'date2' => $date2,
                    'type2text' => $type2text,
                    'opdconfig2' => $opdconfig2,
                    'person' => $person,
                    'date' => $date,
                    'Confirmed' => $Confirmed,
                    'Recovered' => $Recovered,
                    'Hospitalized' => $Hospitalized,
                    'Deaths' => $Deaths,
        ]);
    }

    public function actionSendsuccess() {
        Yii::$app->getSession()->setFlash('success', 'ประมวลผลเรียบร้อยแล้ว!! ');
        return $this->render('sendsuccess');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user_id = Yii::$app->user->getId();
            $ip = \Yii::$app->getRequest()->getUserIP();

            $sql = " INSERT INTO `user_log` (`user_id`, `login_date`, `ip`) VALUES ('$user_id',NOW(), '$ip') ";
            \Yii::$app->db->createCommand($sql)->execute();

            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }

    public function actionNewver() {
        return $this->render('newver');
    }

     public function actionTokenError() {
        return $this->render('_notoken');
    }
}
