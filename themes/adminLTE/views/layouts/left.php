<?php

use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\helpers\Html;

if (Yii::$app->user->isGuest) {
    $username = 'Guest';
} else {
    $username = Yii::$app->user->identity->username;
}

$command0 = Yii::$app->db2->createCommand("
select hospitalcode FROM opdconfig");
$opdconfig = $command0->queryScalar();

$command1 = Yii::$app->db->createCommand("
select CASE
WHEN (select REPLACE(version,'.','') FROM version_mPcu ) <> REPLACE(version,'.','')  THEN 'กรุณาโหลด New Version' 
ELSE 'ท่านใช้  Version ล่าสุดแล้ว' end as check_ver
FROM chospital_amp WHERE hoscode = '$opdconfig'");
$version = $command1->queryScalar();

$command2 = Yii::$app->db->createCommand("
select version
FROM chospital_amp WHERE hoscode = '$opdconfig'");
$ver = $command2->queryScalar();

$command3 = Yii::$app->db2->createCommand("SELECT 
count(*) as cc
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_SCHEMA = 'hosxp_pcu03149' AND TABLE_NAME ='wsc_pcu_oapp'");

$ver0 = $command3->queryScalar();

 $route1 = Url::to(['/site/newver']);
 
?>


<aside class="main-sidebar">
    <br>
    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/avatar3.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= $username ?></p>

                <?php if (Yii::$app->user->isGuest) { ?>

                    <a href="#"><i class="fa fa-circle text-red"></i> Offline</a>
                <?php } else { ?>

                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                <?php } ?>


            </div>
            
            
            
        </div>
            <div class="btn btn-default">          
            <div class="pull-left info">
                <a href="<?= $route1 ?>"><i class="fa fa-circle text-success"></i> <font color="orange">V. <?=$ver?></font></a><br>
                    
            </div>        
        </div>

        <?php if (Yii::$app->user->isGuest) { ?>
        
         <?=
            dmstr\widgets\Menu::widget(
                    [
                        'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                        'items' => [
                               
                              /*  ['label' => 'ประมวลผล', 'icon' => 'hourglass-2', 'url' => ['/pcu/mycount/system-backup-log']],*/
                                
                             
                        
                        ],
                    ]
            )
            ?>

        <?php } else { ?>



            <?=
            dmstr\widgets\Menu::widget(
                    [
                        'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                        'items' => [
                             //   ['label' => 'Download New Version', 'icon' => 'download', 'url' => ['/site/newver']],
                               /* ['label' => 'ประมวลผล', 'icon' => 'hourglass-2', 'url' => ['/pcu/mycount/system-backup-log']],*/
                                ['label' => 'เมนู', 'options' => ['class' => 'header']],
                                ['label' => 'DashBoard', 'icon' => 'dashboard', 'url' => ['/site']],
                                ['label' => 'ตั้งค่าพื้นฐาน', 'icon' => 'gear', 'url' => ['/pcu/default']],
                                ['label' => 'แลกเปลี่ยนข้อมูล', 'icon' => 'exchange', 'url' => ['/pcureport/default/main']],
                             //   ['label' => 'ตั้งค่าส่งข้อมูล', 'icon' => 'exchange', 'url' => ['/f43file/default']],
                            // ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                            ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                        /*  [
                          'label' => 'Some tools',
                          'icon' => 'share',
                          'url' => '#',
                          'items' => [
                          //   ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                          [
                          'label' => 'Level One',
                          'icon' => 'circle-o',
                          'url' => '#',
                          'items' => [
                          ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                          [
                          'label' => 'Level Two',
                          'icon' => 'circle-o',
                          'url' => '#',
                          'items' => [
                          ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                          ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                          ],
                          ],
                          ],
                          ],
                          ],
                          ], */
                        ],
                    ]
            )
            ?>
            <?php
            echo dmstr\widgets\Menu::widget(
                    [
                        'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                        'items' => [
                                ['label' => 'ระบบรายงาน', 'options' => ['class' => 'header']],],]);
            ?>

            <?php
            $i = 1;

            $depList = Yii::$app->db->createCommand("SELECT * FROM hos_basedata where active = 'True' order by id asc")->queryAll();
            foreach ($depList as $ds) {
                echo dmstr\widgets\Menu::widget(
                        [
                            'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                            'items' => [
                                    [
                                    'label' => $ds['base_data'],
                                    'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                                    'icon' => 'file-text-o',
                                    'url' => 'index.php?r=' . $ds['link'],
                                ],
                            ],]);
            }
            ?>

        </section>
<?php } ?>
</aside>
