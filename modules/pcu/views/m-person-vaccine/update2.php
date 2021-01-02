<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MPersonVaccine */

$this->title = 'Update Mperson Vaccine: ' . $model->person_vaccine_id;
$this->params['breadcrumbs'][] = ['label' => 'Mperson Vaccines', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->person_vaccine_id, 'url' => ['view', 'id' => $model->person_vaccine_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mperson-vaccine-update">

   
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
