<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MdrugitemsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mdrugitems-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'icode') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'strength') ?>

    <?= $form->field($model, 'units') ?>

    <?= $form->field($model, 'unitprice') ?>

   
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
