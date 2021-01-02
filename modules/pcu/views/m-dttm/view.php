<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MDttm */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'M Dttms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mdttm-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->code], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->code], [
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
            'code',
            'name',
            'requiredtc',
            'vorder',
            'treatment',
            'icd10',
            'icd9cm',
            'icode',
            'opd_price1',
            'opd_price2',
            'opd_price3',
            'ipd_price1',
            'ipd_price2',
            'ipd_price3',
            'dttm_group_id',
            'unit',
            'charge_per_qty',
            'active_status',
            'dttm_guid',
            'thai_name',
            'charge_area_qty',
            'dttm_subgroup_id',
            'icd10tm_operation_code',
            'dttm_dw_report_group_id',
            'export_proced',
            'dent2006_item_code',
            'hos_guid',
        ],
    ]) ?>

</div>
