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
    'body' => 'รายการที่ท่านเลือกจะถูกนำเข้าไปที่ฐานข้อมูลอัตโนมัติ'
]);
?>

<div class="mwbc-vaccine-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wbc_vaccine_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'wbc_vaccine_name')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'wbc_vaccine_code')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'age_min')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'age_max')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'export_vaccine_code')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'check_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'vaccine_in_use')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'hos_guid')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'icode')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'price')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'combine_vaccine')->hiddenInput()->label(FALSE) ?>

    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
