<?php

//use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'ตั้งค่าพื้นฐาน';
?>

<?php
yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-lg',
    'closeButton' => [
        'id' => 'close-button',
        'class' => 'close',
        'data-dismiss' => 'modal',
    ],
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => [
        'backdrop' => false, 'keyboard' => true,
    ],
]);
echo "<div id='modalContent'> <h3> กำลังประมวลผลข้อมูลกรุณารอสักครู่ </h3> <div style='text-align:center'>" . Html::img('@web/images/ajax-loader.gif') . "</div></div>";
yii\bootstrap\Modal::end();
?>





    <div class="row">
        <div class="col-md-6">

            <div class="row">


                <div class="panel panel-danger">
                    <div class="panel-heading"><h4>1. ปรับปรุงข้อมูล</h4>

                    <div class="panel panel-default">
                    <div class="panel-heading"><h4>1.1 (ทำทุก 1 สัปดาห์) </h4>
                        <?=Html::button('<i class="glyphicon glyphicon-repeat"></i> นำเข้าข้อมูลแพ้ยา', ['value' => Url::to(['default/opdallergy']), 'title' => 'นำเข้าข้อมูลแพ้ยา', 'class' => 'showModalButton btn btn-success']);?>
                   
                    </div>
                    </div>
                    <div class="panel panel-default">
                    <div class="panel-heading"><h4>1.2 (ทำทุก 1 เดือน) </h4>
                        <?=Html::button('<i class="glyphicon glyphicon-repeat"></i> ส่งข้อมูลยา', ['value' => Url::to(['/f43file/default/wscopipcu']), 'title' => 'ส่งข้อมูลยา', 'class' => 'showModalButton btn btn-danger']);?>
                        
                    </div>
                    </div>

                    <div class="panel panel-default">
                    <div class="panel-heading"><h4>1.3 (เมนูเฉพาะกิจ) </h4>
                        <?=Html::button('<i class="glyphicon glyphicon-repeat"></i> นำเข้าวิธีใช้ยา', ['value' => Url::to(['default/drugusage']), 'title' => 'นำเข้าวิธีใช้ยา', 'class' => 'showModalButton btn btn-danger']);?>
                        <?=Html::button('<i class="glyphicon glyphicon-repeat"></i> wsc_cinicmember', ['value' => Url::to(['default/wsc-clinicmember']), 'title' => 'ปรับ wsc_cinicmember', 'class' => 'showModalButton btn btn-success']);?>
                        <?=Html::button('<i class="glyphicon glyphicon-repeat"></i> ปรับรายการยา', ['value' => Url::to(['default/drugnew']), 'title' => 'ปรับรายการยา', 'class' => 'showModalButton btn btn-danger']);?>
                      <?=Html::button('<i class="glyphicon glyphicon-repeat"></i> ปรับรายการ Lab', ['value' => Url::to(['default/wsc-labitems']), 'title' => 'ปรับข้อมูล Lab', 'class' => 'showModalButton btn btn-info']);?>
                        
                    </div>
                    </div>

                    </div>

                    <div class="panel-body">

                           <h5> เมนูนี้ใช้ในการปรับค่าพื้นฐาน </h5>
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading"><h4>3. เกี่ยวกับข้อมูล LAB</h4></div>
                    <div class="panel-body">
                        <p>
                            <?php
/*
$model = LabItems::find()->select('lab_items_code')
->all();

$query = MLabItems::find()
->where(['NOT IN', 'lab_items_code', $model])
->count();*/
echo \yii\helpers\Html::a('3.1) [LAB_ITEMS] รายการ Lab', ['/pcu/m-lab-items/indeximport']);
?>
                        </p>

                        <p>
                            <?php
/*
$provislab = null;
$model = LabItems::find()->select('lab_items_code')
->where(['IS', 'provis_labcode', $provislab])
->all();

$query = MLabItems::find()
->where(['IN', 'lab_items_code', $model])
->andWhere(['IS NOT', 'provis_labcode', $provislab])
->count();*/
echo \yii\helpers\Html::a('3.2) [LAB_ITEMS] ปรับรายการ Provis Labcode เพื่อส่งออก 43 แฟ้ม', ['/pcu/m-lab-items/indexproviscode']);
?>
                        </p>

                    </div>
                </div>

                <div class="panel panel-danger">
                    <div class="panel-heading"><h4>5. เกี่ยวกับข้อมูล SPECIAL PP</h4></div>
                    <div class="panel-body">
                        <p>
                            <?php
/*
$model = app\modules\pcu\models\PpSpecialCode::find()->select('code')
->all();

$query = MPpSpecialCode::find()
->where(['NOT IN', 'code', $model])
->count();*/
echo \yii\helpers\Html::a('5.1) [PP SPECIAL CODE] รายการ PP SPECIAL CODE', ['/pcu/m-pp-special-code/index']);
?>
                        </p>

                        <p>
                            <?php
/*
$model = app\modules\pcu\models\PpSpecialType::find()->select('pp_special_type_id')
->all();

$query = app\modules\pcu\models\MPpSpecialType::find()
->where(['NOT IN', 'pp_special_type_id', $model])
->count();*/
echo \yii\helpers\Html::a('5.2) [PP SPECIAL TYPE] รายการ PP SPECIAL TYPE', ['/pcu/m-pp-special-type/index']);
?>
                        </p>


                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading"><h4>7. เกี่ยวกับข้อมูลบุคคลบัญชี1 / เวชระเบียน</h4></div>
                    <div class="panel-body">
                        <p>
                            <?php
//   echo \yii\helpers\Html::a('7.1) [OPD_ALLERGY] การนำเข้าข้อมูลแพ้ยา', ['/pcu/m-opd-allergy/index']);
?>
                        </p>


                    </div>
                </div>




            </div>

        </div>

        <div class="row">
            <div class="col-md-6">


                <div class="panel panel-primary">
                    <div class="panel-heading"><h4>2. เกี่ยวกับข้อมูลวัคซีน</h4></div>
                    <div class="panel-body">


                        <p>
                            <?php
/*
$model = ProvisVcctype::find()->select('code')
->all();

$query = MProvisVcctype::find()
->where(['NOT IN', 'code', $model])
->count();*/

echo \yii\helpers\Html::a('2.1) [PROVIS_VCCTYPE] ตารางหลักวัคซีน', ['/pcu/m-provis-vcctype/index']);
?>
                        </p>

                        <p>
                            <?php
/*
$model = PersonVaccine::find()->select('vaccine_code')
->all();

$query = MPersonVaccine::find()
->where(['NOT IN', 'vaccine_code', $model])
->count();*/

echo \yii\helpers\Html::a('2.2) [PERSON_VACCINE] ข้อมูลวัคซีนบุคคล(one stop service)', ['/pcu/m-person-vaccine/index']);
?>
                        </p>

                        <p>
                            <?php
/*
$model = \app\modules\pcu\models\WbcVaccine::find()->select('wbc_vaccine_code')
->all();

$query = \app\modules\pcu\models\MWbcVaccine::find()
->where(['NOT IN', 'wbc_vaccine_code', $model])
->count();*/

echo \yii\helpers\Html::a('2.3) [WBC_VACCINE] ข้อมูลวัคซีนเด็ก0-1ปี(งานบัญชี3)', ['/pcu/m-wbc-vaccine/index']);
?>
                        </p>

                        <p>
                            <?php
/*
$model = \app\modules\pcu\models\EpiVaccine::find()->select('vaccine_code')
->all();

$query = \app\modules\pcu\models\MEpiVaccine::find()
->where(['NOT IN', 'vaccine_code', $model])
->count();*/

echo \yii\helpers\Html::a('2.4) [EPI_VACCINE] ข้อมูลวัคซีนเด็ก 1-5ปี(งานบัญชี4)', ['/pcu/m-epi-vaccine/index']);
?>
                        </p>





                    </div>
                </div>

                <div class="panel panel-danger">
                    <div class="panel-heading"><h4>4. เกี่ยวกับข้อมูลทันตกรรม</h4></div>
                    <div class="panel-body">
                        <p>
                            <?php
/*
$model = app\modules\pcu\models\Dttm::find()->select('code')
->all();

$query = MDttm::find()
->where(['NOT IN', 'code', $model])
->count(); */
echo \yii\helpers\Html::a('4.1) [DTTM] รายการทันตกรรม รอนำเข้า', ['/pcu/m-dttm/index']);
?>
                        </p>



                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading"><h4>6. เกี่ยวกับข้อมูลแพทย์แผนไทย</h4></div>
                    <div class="panel-body">
                        <p>
                            <?php
/*
$searchVal = 'U7';
$model = \app\modules\pcu\models\Icd101::find()->select('code')
->all();

$query = app\modules\pcu\models\MIcd101::find()
->where(['NOT IN', 'code', $model])
->andWhere(['like', 'code', $searchVal])
->count();*/
echo \yii\helpers\Html::a('6.1) [ICD10_HEALTH_MED] รหัสวินิจฉัยแพทย์แผนไทย', ['/pcu/m-icd101/index']);
?>
                        </p>



                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="row">
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
                <li class="glyphicon glyphicon-record"> <a href="index.php?r=pcu<?=$ds['link']?>" ><?=$i?> <?=$ds['basedata_sub_name']?>
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

    </div>





