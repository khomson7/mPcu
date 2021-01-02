<?php


use miloschuman\highcharts\Highcharts;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

$this->title = $opdconfig2;
?>
 <div id="loading" class="showloading" style="display:none;">
            <img id="loading-image" src="<?php echo Yii::getAlias('@web').'/'.'/images/loading_animation.gif'?>" alt="Loading..."/>
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