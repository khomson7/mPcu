<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use chiliec\vote\widgets\TopRated;
use kartik\widgets\StarRating;

$this->title;

$this->params['breadcrumbs'][] = ['label' => 'สรุปการยกเลิกบันทึกค้างชำระ', 'url' => ['rcptreport/index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?php



echo StarRating::widget([
    'name' => 'rating_1',
    'pluginOptions' => ['disabled'=>false, 'showClear'=>false]
]);
?>

<?php
$form = ActiveForm::begin(['method' => 'get',
            'action' => Url::to(['rcptreport/report1']),]);
?>
<div class='well'>   
    ระหว่างวันที่:
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <?php
            echo yii\jui\DatePicker::widget([
                'name' => 'date1',
                'value' => $date1,
                'language' => 'th',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true,
                ],
                'options' => [
                    'class' => 'form-control'
                ],
            ]);
            ?>
            ถึงวันที่:
            <?php
            echo yii\jui\DatePicker::widget([
                'name' => 'date2',
                'value' => $date2,
                'language' => 'th',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true,
                ],
                'options' => [
                    'class' => 'form-control'
                ],
            ]);
            ?>
        </div>              
        <div class="col-xs-2 col-sm-2 col-md-2">
            <button class='btn btn-danger'>ประมวลผล</button>
        </div>
    </div>
    <br>
<?php ActiveForm::end(); ?>
</div>

<br>

<div class="alert alert-success" role="alert">คำนิยาม:: <?php

?></div>
<?php Pjax::begin(); ?> 
<?php

echo GridView::widget([
    'dataProvider' => $person,
    //'summary' => "",
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    
    'panel' => [
        'before' => 'รายละเอียด (<b style="color: blue"></b>)',
    //'type' => \kartik\grid\GridView::TYPE_SUCCESS,
    ],
    'hover' => true,
    'columns' => [
            [
            'class' => 'yii\grid\SerialColumn',
        ]
        ,
            [
            'attribute' => 'vn',
            'label' => "VN",
        ],
         [
            'attribute' => 'arrear_date',
            'label' => "วันที่ค้างชำระ",
        ],
        [
            'attribute' => 'arrear_time',
            'label' => "เวลาค้างชำระ",
        ],
                [
            'attribute' => 'amount',
            'label' => "จำนวนเงิน",
        ],
                  [
            'attribute' => 'finance_number',
            'label' => "เลขที่",
        ],
        [
            'attribute' => 'staff',
            'label' => "ผู้ดำเนินการ",
        ],
        
    ]
]);
?>

<?php Pjax::begin(); ?> 

