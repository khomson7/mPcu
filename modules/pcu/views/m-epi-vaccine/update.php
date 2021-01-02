<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MEpiVaccine */

$this->title = 'Update M Epi Vaccine: ' . $model->epi_vaccine_id;
$this->params['breadcrumbs'][] = ['label' => 'M Epi Vaccines', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->epi_vaccine_id, 'url' => ['view', 'id' => $model->epi_vaccine_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mepi-vaccine-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
