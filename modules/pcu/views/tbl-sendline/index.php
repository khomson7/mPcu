<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pcu\models\TblSendlineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Sendlines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-sendline-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tbl Sendline', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username_id',
            'send_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
