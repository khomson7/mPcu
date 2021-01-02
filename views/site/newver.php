<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'What New Version ?';

$command0 = Yii::$app->db->createCommand("
select version FROM version_mPcu");
$m_version = $command0->queryScalar();

?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
<div class="panel panel-danger">
                    <div class="panel-heading"> รายการปรับปรุง VERSION <?= $m_version ?> </div>
                    <div class="panel-body">
                        <p>
                            <?php
                            echo 'V.'.$m_version.'<br>เพิ่มการส่งข้อมูลแจ้งเตือนการนัดผู้ป่วย <br>เพิ่มการค้นคืนข้อมูลวัคซีนเด็ก';
                            
                            ?>
                        </p>    



                    </div>
                </div>


            </div>
        </div>