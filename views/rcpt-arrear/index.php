<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\rating\StarRating;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RcptArrearSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'บันทึกยกเลิกค้างชำระ 30 บาท';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rcpt-arrear-index">


<?php
// Usage with ActiveForm and model

echo StarRating::widget([
    'name' => 'rating_1',
    'pluginOptions' => ['disabled'=>false, 'showClear'=>false]
]);
?>


    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        //'filterModel' => $searchModel,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-calendar"> บันทึกยกเลิกค้างชำระ 30 บาท </i>
               </h3>',
            'type' => 'warning',
   
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> โหลดข้อมูลใหม่', ['/rcpt-arrear/index'], ['class' => 'btn btn-info']),
            'footer' => true,
        ],
        'responsive' => true,
        'hover' => true,
        'bordered' => true,
        'striped' => true,
        
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'arrear_id',
            'vn',
            'arrear_date',
            'arrear_time',
            // 'amount',
            'staff',
            //'rcpno',
            //'finance_number',
            //'paid',
            //'pt_type',
            'hn',
            //'receive_money_date',
            //'receive_money_time',
            //'receive_money_staff',
            //'hos_guid',
            //'an',
            
            
             ['class' => 'yii\grid\ActionColumn',
                'template' => ' {view}',
                'contentOptions' => ['style' => 'width: 8.7%'],
                // 'visible' => Yii::$app->user->isGuest ? false : true,
                'buttons' => [
                    'view' => function ($url, $model) {
                        $t = 'index.php?r=rcpt-arrear/update&id=' . $model->arrear_id;
                        return Html::button('<span class="glyphicon glyphicon-pencil"></span>', ['value' => Url::to($t), 'class' => 'showModalButton btn btn-success']);
                    },
                ], 'urlCreator' => function ($action, $model) {
                    if ($action === 'new_action') {
                        $url = Url::to(['meeting/delete', 'id' => $model->id]);
                        return $url;
                    }
                }
            ],
            
        ],
    ]);
    ?>
</div>

    