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
<div class="micd10-health-med-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'icd10')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['readonly' => true]) ?>




   <?= $form->field($modelsicd, 'code')->hiddenInput()->label(FALSE) ?>
    




    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
