<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MOpdAllergy */

$this->title = $model->hn;
$this->params['breadcrumbs'][] = ['label' => 'Mopd Allergies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mopd-allergy-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'hn' => $model->hn, 'agent' => $model->agent], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'hn' => $model->hn, 'agent' => $model->agent], [
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
            'hn',
            'report_date',
            'agent',
            'symptom',
            'reporter',
            'relation_level',
            'note:ntext',
            'allergy_type',
            'display_order',
            'begin_date',
            'allergy_group_id',
            'seriousness_id',
            'allergy_result_id',
            'allergy_relation_id',
            'ward',
            'department',
            'spclty',
            'entry_datetime',
            'update_datetime',
            'depcode',
            'no_alert',
            'naranjo_result_id',
            'force_no_order',
            'opd_allergy_alert_type_id',
            'hos_guid',
            'adr_preventable_score',
            'preventable',
            'patient_cid',
            'adr_consult_dialog_id',
            'opd_allergy_report_type_id',
            'hos_guid_ext',
            'agent_code24',
            'officer_confirm',
            'icode',
            'opd_allergy_symtom_type_id',
            'opd_allergy_id',
            'cross_group_check',
            'opd_allergy_source_id',
            'opd_allergy_type_id',
            'doctor_code',
            'dosage_text:ntext',
            'usage_text:ntext',
            'lab_text:ntext',
        ],
    ]) ?>

</div>
