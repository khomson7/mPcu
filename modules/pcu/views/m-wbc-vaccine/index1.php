<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pcu\models\MWbcVaccineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'M Wbc Vaccines';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mwbc-vaccine-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create M Wbc Vaccine', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'wbc_vaccine_id',
            'wbc_vaccine_name',
            'wbc_vaccine_code',
            'age_min',
            'age_max',
            //'export_vaccine_code',
            //'check_code',
            //'vaccine_in_use',
            //'hos_guid',
            //'icode',
            //'price',
            //'combine_vaccine',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
