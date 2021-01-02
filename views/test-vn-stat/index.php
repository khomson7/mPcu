<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
//use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Html;
use kartik\grid\GridView;
use yii\jui\Tabs;
use kartik\tabs\TabsX;
?>
<h1><p align="center">บันทึกเปลี่ยนสิทธรักษาพยาบาล</p></h1>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading"><i class="fa fa-search"></i> ค้นหาผู้ป่วย</div>
            <div class="panel-body">

                <?= Html::beginForm(); ?>

                <label for="pwd">เลข VN 12 หลัก : &nbsp;&nbsp; </label>
                <input type="text"  name="vn"  placeholder="">


                &nbsp;&nbsp;<button class='btn btn-danger'>ค้นหา</button>
                <?= Html::endForm(); ?>


            </div>
        </div>
    </div>
</div>

<?php if ($vn <> '') { ?>



    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading"><i class="fa fa-id-card-o"></i>&nbsp;&nbsp;ข้อมูล</div>
                <div class="panel-body">

                    <?php
                    /*
                      if ($sex == '1') {
                      $ipath = Yii::$app->request->baseUrl . '/images/men.png';
                      } else {
                      $ipath = Yii::$app->request->baseUrl . '/images/women.png';
                      } */
                    ?>


                    <div class="row" >
                        <div class="col-md-2">
                            <img src="" class="img-circle" alt="User Image" height="100" width="100" >
                        </div>

                        <div class="col-md-12">
                            <p> ชื่อ-สกุล  : <?= $vn ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; เลข HN: <?= $hn ?> </p>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading"><i class="fa fa-calendar-check-o"></i>&nbsp;&nbsp;วันที่รับบริการ</div>
                <div class="panel-body">


                    <?php
                    $gridColumns = [
                        ['class' => 'kartik\grid\SerialColumn'],
                        [
                            'attribute' => 'vstdate',
                            'label' => 'วัน/เวลามารับบริการ',
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['vstdate'] === '') {
                                    return "<font  color='000000'>" . $model['vstdate'] . "</font>";
                                } else {
                                    return "<font  color='ff0066'>" . $model['vstdate'] . "</font>";
                                }
                            },
                            'filterType' => GridView::FILTER_COLOR,
                            'vAlign' => 'middle',
                            'format' => 'raw',
                            'width' => '150px',
                            'noWrap' => true
                        ],
                        [
                            'attribute' => 'vn',
                            'label' => 'VN',
                            'value' => function($model) {
                                return Html::a(Html::encode($model['vn']), [
                                            'test-vn-stat/update',
                                            'id' => $model['vn']
                                ]);
                            }, // end value
                            'filterType' => GridView::FILTER_COLOR,
                            'hAlign' => 'center',
                            'format' => 'raw',
                        ]
                    ];

                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'autoXlFormat' => true,
                        'export' => [
                            'fontAwesome' => true,
                            'showConfirmAlert' => false,
                            'target' => GridView::TARGET_BLANK
                        ],
                        'columns' => $gridColumns,
                        'resizableColumns' => true,
                        'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),
                    ]);
                    ?>




                </div>
            </div>
        </div>
    <?php } ?>


    <?php
    $this->registerJs('');
    ?>

