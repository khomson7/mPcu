<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RcptArrearSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rcpt Arrears';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rcpt-arrear-index">





    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
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
            
            [
                'class' => 'yii\grid\ActionColumn',
                'options' => ['style' => 'width:90px;'],
                'template' => '<div class="btn-group btn-group-sm" role="group" aria-label="...">{view}</div>',
                'buttons' => [
                    'view' => function($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-search"></i> รายละเอียด', $url, ['class' => 'btn btn-info']);
                    }, //                     
//                    'update'=>function($url,$model,$key){                        
//                        return  Html::a('<i class="glyphicon glyphicon-pencil"></i> Approve', ['riskreports/update', 'id' => $model->id], ['class' => 'btn btn-success']);
//                    
//                    },  
//                    'delete'=>function($url,$model,$key){
//                         return Html::a('<i class="glyphicon glyphicon-trash"></i>  Delete !?', $url,[
//                                'title' => Yii::t('yii', 'Delete'),
//                                'data-confirm' => Yii::t('yii', 'คุณต้องการลบไฟล์นี้?'),
//                                'data-method' => 'post',
//                                'data-pjax' => '0',
//                                'class'=>'btn btn-danger'
//                                ]);
//                    }
                ]
            ],
          
            ['class' => 'yii\grid\ActionColumn',
                'template' => ' {update}',
                'contentOptions' => ['style' => 'width: 8.7%'],
                // 'visible' => Yii::$app->user->isGuest ? false : true,
                'buttons' => [
                    'update' => function ($url, $model) {
                        $t = 'index.php?r=rcpt-arrear/update&id=' . $model->arrear_id;
                        return Html::button('<span class="glyphicon glyphicon-pencil"></span>', ['value' => Url::to($t), 'class' => 'btn btn-default btn-xs custom_button']);
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

    <?php
    Modal::begin(['id' => 'modalView', 'size' => 'modal-sg']);
    echo "<div id='modalContentView'></div>";
    Modal::end();

    Modal::begin([
        'header' => '<h4></h4>',
        'options' => [
            'tabindex' => false,
        ],
        'id' => 'modal',
        'size' => 'modal-sg'
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
    ?>

<?php
$script = <<< JS
               
         
        
$(function(){
$('.custom_button').click(function(){
    $('#modalView').modal('show').find('#modalContentView').load($(this).attr('value'));

});});
        

                

      

     
          

   
JS;
$this->registerJs($script);
?>

