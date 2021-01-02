<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MIcd10HealthMed */

$this->title = 'Update M Icd10 Health Med: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'M Icd10 Health Meds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->icd10]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="micd10-health-med-update">

   

    <?= $this->render('_form', [
        'model' => $model,
        'modelsicd' => $modelsicd,
    ]) ?>

</div>
