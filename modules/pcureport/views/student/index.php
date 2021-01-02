<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = $base_data;
//$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน Hosxp_pcu', 'url' => ['default/index']];
//$this->params['breadcrumbs'][] = $base_data;

?>
<?php
$count = Yii::$app->db->createCommand("SELECT count(id) as cc,sum(count_report) as r_count FROM hos_basedata_sub where active = 'True' and basedata_id = '$basedata_id' ")->queryAll();
foreach ($count as $d) {
    ?>          

    <?php
}
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <font color="#F0FFF0">จำนวน <?php echo $d['cc'] ?> รายงาน
            
            
            </font>
        </div>
        <div class="panel-body">
            <?php
             $i = 1;
            $depList = Yii::$app->db->createCommand("SELECT * FROM hos_basedata_sub where active = 'True' and basedata_id = '$basedata_id' order by id asc")->queryAll();
            foreach ($depList as $ds) {
                ?>


                <p>
                <li class="glyphicon glyphicon-record"> <a href="index.php?r=pcureport<?= $ds['link'] ?>" ><?= $i ?> <?= $ds['basedata_sub_name'] ?>
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



