<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\Drugusage */

$this->title = $model->drugusage;
$this->params['breadcrumbs'][] = ['label' => 'Drugusages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="drugusage-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->drugusage], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->drugusage], [
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
            'drugusage',
            'code',
            'name1',
            'name2',
            'name3',
            'shortlist',
            'idrlink',
            'status',
            'interval1',
            'interval2',
            'interval3',
            'interval4',
            'interval5',
            'interval6',
            'iperday',
            'dosageform',
            'ename1',
            'ename2',
            'ename3',
            'iperdose',
            'drugusage_guid',
            'divide_amount',
            'common_name',
            'drugusage_active',
            'opi_acpc_id',
            'opi_usage_code',
            'opi_dose',
            'opi_unit_name',
            'opi_frequency_code',
            'opi_usage_unit_code',
            'opi_time_code',
            'ipt_injection_sticker_count',
            'hos_guid',
            'hos_guid_ext',
            'no_disp_machine',
            'use_opi_mode2',
            'display_order',
            'doctor_use',
        ],
    ]) ?>

</div>
