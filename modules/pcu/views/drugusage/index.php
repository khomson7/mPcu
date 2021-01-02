<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pcu\models\DrugusageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Drugusages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drugusage-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Drugusage', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'drugusage',
            'code',
            'name1',
            'name2',
            'name3',
            //'shortlist',
            //'idrlink',
            //'status',
            //'interval1',
            //'interval2',
            //'interval3',
            //'interval4',
            //'interval5',
            //'interval6',
            //'iperday',
            //'dosageform',
            //'ename1',
            //'ename2',
            //'ename3',
            //'iperdose',
            //'drugusage_guid',
            //'divide_amount',
            //'common_name',
            //'drugusage_active',
            //'opi_acpc_id',
            //'opi_usage_code',
            //'opi_dose',
            //'opi_unit_name',
            //'opi_frequency_code',
            //'opi_usage_unit_code',
            //'opi_time_code',
            //'ipt_injection_sticker_count',
            //'hos_guid',
            //'hos_guid_ext',
            //'no_disp_machine',
            //'use_opi_mode2',
            //'display_order',
            //'doctor_use',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
