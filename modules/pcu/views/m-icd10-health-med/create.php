<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MIcd10HealthMed */

$this->title = 'Create M Icd10 Health Med';
$this->params['breadcrumbs'][] = ['label' => 'M Icd10 Health Meds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="micd10-health-med-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
