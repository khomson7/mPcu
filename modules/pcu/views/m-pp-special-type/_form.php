<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MPpSpecialType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mpp-special-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pp_special_type_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'pp_special_type_name')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'pp_special_code')->textInput(['readonly' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
