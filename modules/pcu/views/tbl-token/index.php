<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pcu\models\TblTokenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Tokens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-token-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tbl Token', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username_id',
            'token_',
            'user_access_group',
            'group_name',
            //'group_status',
            //'department_id',
            //'active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
