<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MWbcVaccine */

$this->title = $model->wbc_vaccine_id;
$this->params['breadcrumbs'][] = ['label' => 'M Wbc Vaccines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mwbc-vaccine-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->wbc_vaccine_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->wbc_vaccine_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'wbc_vaccine_id',
            'wbc_vaccine_name',
            'wbc_vaccine_code',
            'age_min',
            'age_max',
            'export_vaccine_code',
            'check_code',
            'vaccine_in_use',
            'hos_guid',
            'icode',
            'price',
            'combine_vaccine',
        ],
    ]) ?>

</div>
