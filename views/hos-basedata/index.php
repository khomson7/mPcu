<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HosBasedataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hos Basedatas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hos-basedata-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Hos Basedata', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'base_data',
            'detail:ntext',
            'link',
            'active',
            //'count_report',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
