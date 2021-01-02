<?php

use miloschuman\highcharts\Highcharts;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = $opdconfig2;
?>
<div class="row">
    <div class="col-xl-12 col-md-12">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="box box-warning box-solid">
                    <section class="index-page text-center">
                        <div class="index-page">
                            <?php
                            $data_api1 = file_get_contents('https://covid19.th-stat.com/api/open/today');
                            $json_api1 = json_decode($data_api1, true);
                            ?>
                            <h2>
                                <FONT COLOR=green>รายงานสถานการณ์ โควิด-19</font>
                            </h2>
                            ข้อมูลจาก:กรมความคุมโรค https://covid19.th-stat.com/thalamencephalon

                            <p>
                                อัพเดทข้อมูลล่าสุด : 
                                <?= $json_api1['UpdateDate'] ?>
                            <p>

                        </div>
                        <div class="row">

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4" style="background-color:deeppink;">
                                    <div class="card-body">

                                        <p class="font-weight-normal mb-3">ติดเชื้อสะสม</p>
                                        <h1 class="mb-5" align="center"><FONT COLOR=white><?= $json_api1['Confirmed'] ?> (ราย)</FONT></h1>
                                        <p class="mb-5">เพิ่มขึ้น <?= $json_api1['NewConfirmed'] ?> (ราย)</p>

                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4" style="background-color:green;">
                                    <div class="card-body">
                                        <p class="font-weight-normal mb-12">หายแล้ว</p>
                                        <h1 class="mb-5" align="center"><FONT COLOR=white><?= $json_api1['Recovered'] ?> (ราย)</Font></h1>
                                        <p class="mb-5">เพิ่มขึ้น <?= $json_api1['NewRecovered'] ?> (ราย)</p>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4" style="background-color:lightseagreen;">
                                    <div class="card-body">
                                        <p class="font-weight-normal mb-3">รักษาอยู่ใน รพ.</p>
                                        <h1 class="mb-5" align="center"><FONT COLOR=white><?= $json_api1['Hospitalized'] ?> (ราย)</FONT></h1>
                                        <p class="mb-5">เพิ่มขึ้น <?= $json_api1['NewHospitalized'] ?> (ราย)</p>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4" style="background-color:gray;">
                                    <div class="card-body">
                                        <p class="font-weight-normal mb-3" >เสียชีวิต</p>
                                        <h1 class="mb-5" align="center"><FONT COLOR=white><?= $json_api1['Deaths'] ?> (ราย)</FONT></h1>
                                        <p class="mb-5">เพิ่มขึ้น <?= $json_api1['NewDeaths'] ?> (ราย)</p>
                                    </div>

                                </div>
                            </div>


                        </div>

                    </section>
                </div>
            </div>

        </div>
    </div>

    <div class="col-xl-6 col-md-6">


        <div class="col-xl-6">
            <div class="box box-warning box-solid">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-bar-chart"></i> แผนที่ระบาด </h3>
                </div>
                <div class="card-body">
                    <div class="embed-responsive embed-responsive-16by9" width="100%">
                        <iframe src="https://covid19.th-stat.com/th/share/map" 
                                frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-6">
    <?php
    $data_api4 = file_get_contents('https://covid19.th-stat.com/api/open/area');
    $json_api4 = json_decode($data_api4, true);
    ?>
    <div class="panel panel-green">
        <div class="col-xl-6">
            <div class="box box-warning box-danger">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-book"></i> ประกาศสถานการณ์ </h3>
                </div>
                <div class="panel-body">

                    <div class="bs-example" data-example-id="contextual-table">
                        <table class="table table-striped  table-hover" id="dataTables-example">
                            <thead class='bg-info text-light'>
                                <tr>
                                    <th class='font-weight-bold'>Date</th> 
                                    <th class='font-weight-bold'>Time</th> 
                                    <th class='font-weight-bold'>Detail</th> 
                                    <th class='font-weight-bold'>Location</th> 
                                    <th class='font-weight-bold'>Recommend</th> 
                                    <th class='font-weight-bold'>AnnounceBy</th> 
                                    <th class='font-weight-bold'>Province</th> 
                                    <th class='font-weight-bold'>ProvinceEn </th>
                                    <th class='font-weight-bold'>Update</th>
                                </tr>
                            </thead>



                            <tbody>
                                <?php
                                foreach ($json_api4['Data'] as $key => $value) {
                                    echo "<tr>";
                                    if (!is_array($value)) {
                                        echo "<td>" . $val . "</td> ";
                                    } else {
                                        foreach ($value as $key => $val) {
                                            echo "<td>" . $val . "</td> ";
                                        }
                                    }
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>


                    <!-- ส่วนแสดงกราฟ -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="glyphicon glyphicon-signal"></i>
                                รายงาน TimeLine โควิด-19


                            </h3>
                        </div>


                        <div class="panel-body">
                            <?php
                            echo Highcharts::widget([
                                'options' => [
                                    'title' => ['text' => 'รายงาน TimeLine โควิด-19'],
                                    'xAxis' => [
                                        'categories' => /* [$date], */ $date
                                    ],
                                    'yAxis' => [
                                        'title' => ['text' => 'จำนวน']
                                    ],
                                    'tooltip' => [
                                        'split' => true,
                                        'valueSuffix' => 'ราย'
                                    ],
                                    'plotOptions' => [
                                        'area' => [
                                            'stacking' => 'normal',
                                            'lineColor' => '#96081d',
                                            'lineWidth' => 1,
                                            'marker' => [
                                                'lineWidth' => 1,
                                                'lineColor' => '#96081d'
                                            ]
                                        ]
                                    ],
                                    'series' => [
                                        [
                                            'type' => 'area',
                                            'name' => '(ติดเชื้อ)รายใหม่',
                                            'data' => $Confirmed
                                        ],
                                        [
                                            'type' => 'area',
                                            'name' => '(หายแล้ว)เพิ่มขึ้น',
                                            'data' => $Recovered
                                        ],
                                        [
                                            'type' => 'line',
                                            'name' => '(รักษาอยู่ใน รพ.)เพิ่มขึ้น',
                                            'data' => $Hospitalized
                                        ],
                                    /*
                                      [
                                      'type' => 'line',
                                      'name' => '(เสียชีวิต)เพิ่มขึ้น',
                                      'data' =>  $Deaths
                                      ], */
                                    ]
                                ]
                            ]);
                            ?>
                        </div>
                    </div>



                    <div class="box box-warning box-solid">
                        <div class="box-header">
                            <h3 class="box-title"><i class="fa fa-bar-chart"></i> <?= $person ?></h3>
                        </div>
                        <div class="box-body">
<?=
Highcharts::widget([
    'options' => [
        'title' => ['text' => $person],
        'xAxis' => [
            'categories' => [$type2text]
        ],
        'yAxis' => [
            'title' => ['text' => 'จำนวนประชากรแต่ละTypearea (คน)']
        ],
        'series' => [
            ['type' => 'column',
                'name' => 'TypeArea1',
                'data' => [$type1]],
            ['type' => 'column',
                'name' => 'TypeArea2',
                'data' => [$type2]],
            ['type' => 'column',
                'name' => 'TypeArea3',
                'data' => [$type3]],
            ['type' => 'column',
                'name' => 'TypeArea4',
                'data' => [$type4]],
        ],
    ]
])
?>
                        </div>
                    </div>


                            <?php
//echo yii\grid\GridView::widget([
                            echo \kartik\grid\GridView::widget([
                                'dataProvider' => $dataProvider1,
                                'responsive' => TRUE,
                                'hover' => true,
                                'exportConfig' => [
                                    //    GridView::PDF => [],
                                    GridView::EXCEL => []
                                ],
                                //'floatHeader' => true,
                                'panel' => [
                                    'heading' => '<h3 class="panel-title"><i class="fa fa-bar-chart"></i>' . $person . ' (คลิกเพื่อดูรายละเอียด)' . '</h3>',
                                    'before' => '',
                                    'type' => \kartik\grid\GridView::TYPE_SUCCESS,
                                ],
                                'columns' => [
                                    [
                                        'attribute' => 'tname',
                                        'label' => 'รายการ'
                                    ],
                                    [
                                        'attribute' => 'type1',
                                        'label' => "TypeArea_1(คน)",
                                        'contentOptions' => [
                                            'style' => 'background-color:;color:white'
                                        ],
                                        'format' => 'raw',
                                        'value' => function($data) {
                                            return Html::a(Html::encode($data['type1']), 'index.php?r=' . $data['link1'], ['data-pjax' => 0, 'target' => "_blank"]);
                                        }
                                    ],
                                    [
                                        'attribute' => 'type2',
                                        'label' => "TypeArea_2(คน)",
                                        'contentOptions' => [
                                            'style' => 'background-color:;color:white'
                                        ],
                                        'format' => 'raw',
                                        'value' => function($data) {
                                            return Html::a(Html::encode($data['type2']), 'index.php?r=' . $data['link2'], ['data-pjax' => 0, 'target' => "_blank"]);
                                        }
                                    ],
                                    [
                                        'attribute' => 'type3',
                                        'label' => "TypeArea_3(คน)",
                                        'contentOptions' => [
                                            'style' => 'background-color:;color:white'
                                        ],
                                        'format' => 'raw',
                                        'value' => function($data) {
                                            return Html::a(Html::encode($data['type3']), 'index.php?r=' . $data['link3'], ['data-pjax' => 0, 'target' => "_blank"]);
                                        }
                                    ],
                                    [
                                        'attribute' => 'type4',
                                        'label' => "TypeArea_4(คน)",
                                        'contentOptions' => [
                                            'style' => 'background-color:;color:white'
                                        ],
                                        'format' => 'raw',
                                        'value' => function($data) {
                                            return Html::a(Html::encode($data['type4']), 'index.php?r=' . $data['link4'], ['data-pjax' => 0, 'target' => "_blank"]);
                                        }
                                    ],
                                    [
                                        'attribute' => 'all_target',
                                        'label' => 'จำนวนทั้งหมด (คน)'
                                    ],
                                    [
                                        'attribute' => 'edit_in_year',
                                        'label' => 'รายการปรับข้อมูล'
                                    ],
                                    [
                                        'attribute' => 'd_update',
                                        'label' => 'วันที่ประมวลผล'
                                    ],
                                ]
                            ])
                            ?>


                    <?php Pjax::begin(['id' => 'my-pjax', 'timeout' => 10000]) ?>

                    <div class="panel panel-primary">
                        <div class="panel-heading"><h4> ติดตามตัวชี้วัดหนวยบริการ</h4></div>
                        <div class="panel panel-warning">
                            <div class="panel-heading"> พิมพ์ชื่อตัวชี้วัด / กลุ่มตัวชี้วัด แล้วกดปุ่มค้นหา
                                <div class="_search" style="margin-bottom: 5px">

<?php
$form = ActiveForm::begin([
            'action' => ['/site/index'],
            'method' => 'get',
            'options' => ['data-pjax' => true]
        ]);
?>

                                    <div class="input-group">
                                        <div class="md-form mt-0">
                                            <div class="panel panel-danger">
                                    <?= Html::textInput('find', $find, ['placeholder' => "--พิมพ์รายการ-- ", "class" => "input-group"]) ?>
                                            </div>
                                            <button class="btn btn-info" type="submit">ค้นหา</button>
                                        </div>
                                    </div>





<?php ActiveForm::end(); ?>

                                </div>



                                    <?php
                                    echo GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        'panel' => [
                                            'before' => '<div><font color="blue">' . '(' . $mainindex . ')' . '</font></div>',
                                        ],
                                        'exportConfig' => [
                                            //  GridView::PDF => [],
                                            GridView::EXCEL => []
                                        ],
                                        'columns' => [
                                            [
                                                'class' => 'yii\grid\SerialColumn'
                                            ],
                                            [
                                                'attribute' => 'kpi_type_name',
                                                'label' => "กลุ่มตัวชี้วัด",
                                                'contentOptions' => [
                                                    'style' => 'background-color:#FFA07A;color:white'
                                                ]
                                            ],
                                            [
                                                'attribute' => 'kpi_name',
                                                'label' => "ชื่อตัวชี้วัด",
                                                'contentOptions' => [
                                                    'style' => 'background-color:;color:white'
                                                ],
                                                'format' => 'raw',
                                                'value' => function($data) {
                                                    return Html::a(Html::encode($data['kpi_name']), $data['hdc_link'], ['data-pjax' => 0, 'target' => "_blank"]);
                                                }
                                            ],
                                            [
                                                'attribute' => 'main_target',
                                                'label' => "เกณฑ์เป้าหมาย",
                                                'contentOptions' => [
                                                    'style' => 'background-color:#FFA07A;color:white'
                                                ]
                                            ],
                                            [
                                                'attribute' => 'target',
                                                'label' => "จำนวนทั้งหมด",
                                                'contentOptions' => [
                                                    'style' => 'background-color:pink;color:pink'
                                                ],
                                                'format' => 'raw',
                                                'value' => function($data) {
                                                    return Html::a(Html::encode($data['target']), ['' . $data['id_link2']], ['data-pjax' => 0, 'target' => "_blank"]);
                                                }
                                            ],
                                            [
                                                'attribute' => 'result',
                                                'label' => "ผลงาน",
                                                'contentOptions' => [
                                                    'style' => 'background-color:grey;color:pink'
                                                ]
                                            ],
                                            [
                                                'attribute' => 'percent',
                                                'label' => "ร้อยละ",
                                                'contentOptions' => [
                                                    'style' => 'background-color:grey;color:pink'
                                                ]
                                            ],
                                            [
                                                'attribute' => 'wait_for',
                                                'label' => "รอดำเนินการ",
                                                'contentOptions' => [
                                                    'style' => 'background-color:orange;color:pink'
                                                ],
                                                'format' => 'raw',
                                                'value' => function($data) {
                                                    return Html::a(Html::encode($data['wait_for']), ['' . $data['wait_for_link2']], ['data-pjax' => 0, 'target' => "_blank"]);
                                                }
                                            ],
                                            [
                                                'attribute' => 'td_update',
                                                'label' => "วันเวลาประมวลผล",
                                                'contentOptions' => [
                                                //   'style' => 'background-color:grey;color:pink'
                                                ]
                                            ],
                                        ]
                                    ]);
                                    ?>
                                <?php Pjax::end() ?>
                            </div>
                        </div>
                    </div>