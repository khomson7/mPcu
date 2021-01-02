<?php



$this->title = 'โหลด New Version';


$ver = file_get_contents(Yii::getAlias('../version/version.txt'));
$ver = explode(',', $ver);


$count = Yii::$app->db->createCommand("SELECT version FROM version_mPcu")->queryAll();
foreach ($count as $d) {
    ?>          

    <?php
}
?>

<div class="box-header">
    <h3 class="box-title"><i class="fa fa-paperclip"></i> Curentversion <?= $ver[0] ?>  </h3>
</div>

<?php
echo '<a href="http://203.157.130.135/load/mPcu.zip" target="_blank"><div class="btn btn-success">DownLoad New Version</div></a>';
?>
<div class="box-header">
    <h3 class="box-title"><i class="fa fa-paperclip"></i> Newversion <?php echo $d['version'] ?> </h3>
</div>