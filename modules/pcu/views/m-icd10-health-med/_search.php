<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MIcd10HealthMedSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="micd10-health-med-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'icd10') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'hos_guid') ?>

    <?= $form->field($model, 'hos_guid_ext') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
