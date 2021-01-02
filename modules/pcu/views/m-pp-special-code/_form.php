<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MPpSpecialCode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mpp-special-code-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'pp_special_code_group')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'pp_special_code_subgroup')->hiddenInput()->label(FALSE) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
