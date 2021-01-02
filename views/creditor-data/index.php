<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CreditorDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการเจ้าหนี้';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="creditor-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่มข้อมูล', ['create'], ['class' => 'showModalButton btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'order_number',
            'parties',
           // 'type_id',
            'receiver_number',
            //'amount',
            //'remark:ntext',

              ['class' => 'yii\grid\ActionColumn',
                'template' => ' {view}',
                'contentOptions' => ['style' => 'width: 8.7%'],
                // 'visible' => Yii::$app->user->isGuest ? false : true,
                'buttons' => [
                    'view' => function ($url, $model) {
                        $t = 'index.php?r=creditor-data/update&id=' . $model->id;
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
    ]); ?>
</div>
