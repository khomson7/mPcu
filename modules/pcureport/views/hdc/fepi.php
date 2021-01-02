<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
//use yii\grid\GridView;

$this->title = 'ข้อมูลวัคซีน';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php

$form = ActiveForm::begin(['method' => 'get',
            'action' => Url::to(['hdc/fepi']),]);
?>
 
  
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><i class="fa fa-search"></i> ค้นหา</div>
                <div class="panel-body">



                    <label for="pwd">พิมพ์เลขบัตรประชาชน 13 หลัก : &nbsp;&nbsp; </label>
                    <input type="hex"  name="user"  placeholder="">


                    &nbsp;&nbsp;<button class='btn btn-danger'>ค้นหา</button>



                </div>
            </div>
        </div>
    </div>
    
    <?php ActiveForm::end(); ?>


<br>

    
       

                 
                <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
            'exportConfig' => [
                GridView::EXCEL => []
            ],
            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                //  'heading' => '111',
                'before' => '<div><font color="blue">' . '(ชื่อ - สกุล: ' . $ptname .')'. '</font></div>'
                . '<div><font color="red">'. '(ว/ด/ป เกิด: ' . $birthdate . ')' . '</font></div>',
            ],
            'responsive' => true,
            'hover' => true,
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                ]
                ,
                [
                    'attribute' => 'VACCINETYPE',
                    'label' => "รหัสวัคซีน",
                ],
                [
                    'attribute' => 'vaccine_code',
                    'label' => "VaccineCode",
                ],
                [
                    'attribute' => 'vaccine_name',
                    'label' => "ชื่อวัคซีน",
                ],
                 [
                    'attribute' => 'vaccine',
                    'label' => "หน่วยบริการ/วันที่ให้บริการ",
                ],
              /*  
                [
                    'attribute' => 'NAME',
                    'label' => "ชื่อ",
                ],
                [
                    'attribute' => 'LNAME',
                    'label' => "สกุล",
                ],
                [
                    'attribute' => 'birthdate',
                    'label' => "ว/ด/ป เกิด",
                ],
                [
                    'attribute' => 'age_y',
                    'label' => "อายุ",
                ],
                [
                    'attribute' => 'after_birth',
                    'label' => "ว/ด/ป ที่รับ dT ครั้งล่าสุด",
                ],
                [
                    'attribute' => 'total_befor_birth',
                    'label' => "จำนวนครั้งที่เคยได้รับวัคซีน dT",
                ],
                [
                    'attribute' => 'vaccine_date',
                    'label' => "ว/ด/ป ที่ควรได้รับวัคซีนเข็มแรก",
                ],
                [
                    'attribute' => 'vaccine_date2',
                    'label' => "ว/ด/ป ที่ควรได้รับวัคซีนเข็มที่2",
                ],
                [
                    'attribute' => 'vaccine_date3',
                    'label' => "ว/ด/ป ที่ควรได้รับวัคซีนเข็มที่3",
                ],
                
                */
            ]
        ]);
        ?>
         
    
