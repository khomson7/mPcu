<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestVnStatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Test Vn Stats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-vn-stat-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Test Vn Stat', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'vn',
            'hn',
            'pttype',
            'vstdate',

            ['class' => 'yii\grid\ActionColumn',
                'template' => ' {view}',
                'contentOptions' => ['style' => 'width: 8.7%'],
                // 'visible' => Yii::$app->user->isGuest ? false : true,
                'buttons' => [
                    'view' => function ($url, $model) {
                        $t = 'index.php?r=test-vn-stat/update&id=' . $model->vn;
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
