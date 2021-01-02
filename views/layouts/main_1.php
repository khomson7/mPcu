<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\Modal;
use app\modules\pcu\models\Drugitems;
use app\modules\pcu\models\Mdrugitems;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <style type="text/css">
            img{
                padding: 70px 15px 20px;
            }
        </style>
    </head>
    <body>
        <?php
       
       $check_status = '1';
        $model = Drugitems::find()->select('icode')/* ->asArray() */
                ->all();

        $query = Mdrugitems::find()
                ->where(['NOT IN', 'icode', $model])
                ->andWhere('check_status = :check_status', [':check_status' => $check_status])
                ->count();
        ?>
        <?php
        $username = '';


        if (!Yii::$app->user->isGuest) {
            $username = '(' . Html::encode(Yii::$app->user->identity->username) . ')';
        }
        ?>
        <?php $this->beginBody() ?>

        <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

        if (Yii::$app->user->isGuest) {

            $submenuItems[] = ['label' => 'เข้าระบบ', 'url' => ['/site/login']];
        } else {
            if (Yii::$app->user->identity->role == 1) {
                $submenuItems[] = [
                
                'label' => '<i class="glyphicon glyphicon-plus"></i> เพิ่มผู้ใช้ใหม่',
                'url' => ['/user/admin/create']];
            }
                      
            $submenuItems[] = [
                
                'label' => 'ออกจากระบบ',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
        }
         $rpt_mnu_itms[] = ['label' => '<i class="glyphicon glyphicon-home"></i> หน้าหลักรายงาน ', 'url' => ['/pcureport/default/index']];
        $i = 1;
            $depList = Yii::$app->db->createCommand("SELECT * FROM hos_basedata where active = 'True' order by id asc")->queryAll();
            foreach ($depList as $ds) {
        
        $rpt_mnu_itms[] = ['label' => '<i class="glyphicon glyphicon-unchecked"></i> ' .$ds['base_data'].' [ จำนวน'.$ds['count_report'].' รายการ ]', 'url' => 'index.php?r='.$ds['link']];
     
        $i++;
            }


        if (Yii::$app->user->isGuest) {

            $menuItems = [
                    ['label' => '<i class="glyphicon glyphicon-user"></i> ผู้ใช้ ',
                    'items' => $submenuItems
                ],
                    ['label' => 'เกี่ยวกับ', 'url' => ['/site/about']],
            ];
        }

        if (!Yii::$app->user->isGuest) {
            
             
            $menuItems = [
                /* ['label' =>
                  '<i class="glyphicon glyphicon-floppy-open"></i> นำเข้า',
                  'url' => ['/uploadfortythree/index']
                  ], */
                    ['label' =>
                    '<i class="glyphicon glyphicon-list-alt"></i> ระบบรายงาน',
                    'items' => $rpt_mnu_itms
                ],
                /*
                  ['label' =>
                  '<i class="glyphicon glyphicon-usd"></i> ระบบงานเจ้าหนี้การค้า',
                  'items' => $rpt_mnu_itms2
                  ], */
                    ['label' => '<i class="glyphicon glyphicon-user"></i> ผู้ใช้ ' . $username,
                    'items' => $submenuItems
                ],
                    ['label' => 'เกี่ยวกับ', 'url' => ['/site/about']],
            ];
        }






        //  $config_main = backend\models\Sysconfigmain::find()->one();



        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'encodeLabels' => false,
            'items' => $menuItems,
        ]);

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'encodeLabels' => false,
        ]);

        NavBar::end();
        ?>

            <!--
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                
                'items' => [
                    ['label' => 'รายงานการเงิน', 'url' => ['/rcptreport/index']],
                    ['label' => 'ยกเลิกค้างชำระ', 'url' => ['/rcpt-arrear/index']],
                    
                    Yii::$app->user->isGuest ? (
                            ['label' => 'เข้าใช้งาน', 'url' => ['/user/security/login']]
                            ) : (
                            '<li>'
                            . Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                    'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm()
                            . '</li>'
                            )
                ],
            ]);
            NavBar::end();
            -->

            <div class="container">
<?=
Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
])
?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

                <?php
                yii\bootstrap\Modal::begin([
                    'id' => 'modal',
                    'size' => 'modal-lg',
                ]);
                echo "<div id='modalContent'></div>";
                yii\bootstrap\Modal::end();
                ?>



        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; My Company <?= date('Y') ?></p>


            </div>
        </footer>

<?php $this->endBody() ?>
    </body>
</html>
        <?php $this->endPage() ?>
