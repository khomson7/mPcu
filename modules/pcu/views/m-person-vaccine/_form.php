<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Alert;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MProvisVcctype */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
echo Alert::widget([
    'type' => Alert::TYPE_DANGER,
    'title' => 'Note',
    'titleOptions' => ['icon' => 'info-sign'],
    'body' => 'รายการที่ท่านเลือกจะถูกนำเข้าอัตโนมัติ'
]);
?>

<div class="mperson-vaccine-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'person_vaccine_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'vaccine_name')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'vaccine_code')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'vaccine_group')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'export_vaccine_code')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'hos_guid')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'combine_vaccine')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'icode')->hiddenInput()->label(FALSE) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
