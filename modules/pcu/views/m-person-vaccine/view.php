<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MPersonVaccine */

$this->title = $model->person_vaccine_id;
$this->params['breadcrumbs'][] = ['label' => 'Mperson Vaccines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mperson-vaccine-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->person_vaccine_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->person_vaccine_id], [
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
            'person_vaccine_id',
            'vaccine_name',
            'vaccine_code',
            'vaccine_group',
            'export_vaccine_code',
            'hos_guid',
            'combine_vaccine',
            'icode',
        ],
    ]) ?>

</div>
