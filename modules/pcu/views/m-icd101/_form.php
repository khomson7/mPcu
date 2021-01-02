<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use hauntd\vote\widgets\Vote;
use kartik\widgets\StarRating;
use kartik\widgets\Alert;
?>
<?php
echo Alert::widget([
    'type' => Alert::TYPE_DANGER,
    'title' => 'Note',
    'titleOptions' => ['icon' => 'info-sign'],
    'body' => 'รายการที่ท่านเลือกจะถูกปรับปรุง'
]);
?>

<div class="micd101-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'spclty')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'tname')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'code3')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'code4')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'code5')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'sex')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'ipd_valid')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'icd10compat')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'icd10tmcompat')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'active_status')->hiddenInput()->label(FALSE) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
