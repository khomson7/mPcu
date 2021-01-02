
<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->params['breadcrumbs'][] = 'ระบบรายงาน hosxp_pcu';
?>
<?php
$count = Yii::$app->db->createCommand("SELECT count(id) as cc,sum(count_report) as r_count FROM hos_basedata where active = 'True' ")->queryAll();
foreach ($count as $d) {
    ?>          

    <?php
}
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <font color="#F0FFF0">จำนวน <?php echo $d['cc'] ?> กลุ่มรายงาน
            <span class="label pull-right rounded btn-danger">รายงานทั้งหมด : <?php echo number_format($d['r_count']); ?></span>
            
            </font>
        </div>
        <div class="panel-body">
            <?php
             $i = 1;
            $depList = Yii::$app->db->createCommand("SELECT * FROM hos_basedata where active = 'True' order by id asc")->queryAll();
            foreach ($depList as $ds) {
                ?>


                <p>
                <li class="glyphicon glyphicon-record"> <a href="index.php?r=<?= $ds['link'] ?>" ><?= $i ?> <?= $ds['base_data'] ?>
                    </a></li>
                </p>

                <?php
                 $i++;
            }
            ?>
        </div>
    </div>
</div>   
</div>

<div class="footerrow" style="padding-top: 60px">
    <div class="alert alert-success">

    </div>
</div>
