<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MPpSpecialTypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mpp-special-type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pp_special_type_id') ?>

    <?= $form->field($model, 'pp_special_type_name') ?>

    <?= $form->field($model, 'hos_guid') ?>

    <?= $form->field($model, 'pp_special_code') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
