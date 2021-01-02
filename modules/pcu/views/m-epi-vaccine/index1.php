<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pcu\models\MEpiVaccineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'M Epi Vaccines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mepi-vaccine-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create M Epi Vaccine', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'epi_vaccine_id',
            'epi_vaccine_name',
            'vaccine_code',
            'age_min',
            'age_max',
            //'export_vaccine_code',
            //'vaccine_in_use',
            //'hos_guid',
            //'icode',
            //'price',
            //'combine_vaccine',
            //'check_code',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
