<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MWbcVaccine */

$this->title = 'Update M Wbc Vaccine: ' . $model->wbc_vaccine_id;
$this->params['breadcrumbs'][] = ['label' => 'M Wbc Vaccines', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->wbc_vaccine_id, 'url' => ['view', 'id' => $model->wbc_vaccine_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mwbc-vaccine-update">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
