<?php
use yii\helpers\Html;
use yii\base\BaseObject;
use yii\helpers\Url;

if (Yii::$app->user->isGuest) { 
    $username = 'Guest';    
} else {
$username = Yii::$app->user->identity->username;
}
?>


<header class="main-header">

    <?= Html::a('<span class="logo-mini">mPcu</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">1</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 1 messages</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li><!-- start message -->
                                    <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>">
                                        <div class="pull-left">
                                            <img src="<?= $directoryAsset ?>/img/avatar3.png" class="img-circle"
                                                 alt="User Image"/>
                                        </div>
                                        <h4>
                                            ##
                                            <small><i class="fa fa-clock-o"></i> 2/07/2563</small>
                                        </h4>
                                        <p>##</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                       <!-- <li class="footer"><a href="#">See All Messages</a></li> -->
                    </ul>
                </li>
                
                
                   <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"> รายงานทั้งหมด</i>
                                <span class="label label-danger"><?php
                                            $var = 'True' ;
                                    echo \app\modules\pcureport\models\HosBasedataSub::find()
                                            // ->Where($$var)
                                           ->where(['active' => $var])
                                         //   ->andWhere($var)
                                           // ->andWhere(['=', 'department_id', Yii::$app->user->identity->department_id])
                                            ->count();
                                    ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header"><span class="label label-danger">รายงานทั้งหมด <?php
                                        echo \app\modules\pcureport\models\HosBasedataSub::find()
                                                //  ->Where($risk_s)
                                               ->where(['active' => $var])
                                               // ->andWhere(['=', 'department_id', Yii::$app->user->identity->department_id])
                                                ->count();
                                        ?> รายการ</span></li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <?php
                                       $w = 'h.active in("True")';
                                        
                                       $s = 'h.id,h.basedata_sub_name,h.d_update,h.link';
                                    //    $u = Yii::$app->user->identity->department_id;
                                     //   $office = 'r.department_id';
                                        $tasks_noti = (new \yii\db\Query())
                                                ->select($s)
                                                ->from('hos_basedata_sub h')
                                                ->orderBy(['d_update' => SORT_DESC,])
                                                /*
                                                  ->leftJoin('sys_report r', 'n.report_id=r.report_id')

                                                 */
                                                ->where($w)
                                               // ->andWhere($var)
                                              //  ->andWhere([$office => $u])
                                                /*
                                                  ->groupBy($g)
                                                  ->orderBy(['percent' => SORT_DESC,])
                                                 * 
                                                 */
                                                ->all(\Yii::$app->db);
                                        $row = 1;
                                        foreach ($tasks_noti as $ds) {
                                            ?>
                                        
                             
                                
                                            <li><!-- start message -->
                                                <a href="index.php?r=pcureport<?= $ds['link'] ?>">
                                                    
                                                    <h4>
                                            รายงาน
                                                        <small><i class="fa fa-clock-o"></i> <?= $ds['d_update'] ?></small>
                                                      </h4>  
                                                    
                                                     <i class="fa fa-users text-red"></i> <font color="#32CD32"><?= $ds['basedata_sub_name'] ?></font>
                                                    
                                                   
                                                    
                                                </a>
                                                <?php
                                                $row++;
                                            }
                                            ?>
                                        </li>
                                    </ul>
                                </li>

                                <li class="footer"><a href="<?= \yii\helpers\Url::to(['/pcureport/default/index']) ?>">ดูทุกรายการ</a></li>
                            </ul>
                       
                    </li>
                
                
                <!-- User Account: style can be found in dropdown.less -->
                
                 <ul class="nav navbar-nav">
                <?php if (Yii::$app->user->isGuest) { ?>
                    <li><a href="<?php echo Url::to(['/user/security/login']); ?>">
                            <i class="glyphicon glyphicon-log-in"></i>
                            <span> เข้าสู่ระบบ</span>
                            <small class="label pull-right bg-blue"></small></a>
                    </li>

                <?php } ?>



            </ul>
                        <?php if (!Yii::$app->user->isGuest) { ?>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/avatar3.png" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?= $username ?></span>
                    </a>
                        <?php } ?>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/avatar3.png" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <?= $username ?>
                                <small>โรงพยาบาบาลส่งเสริมสุขภาพตำบล</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

             
            </ul>
        </div>
    </nav>
</header>
