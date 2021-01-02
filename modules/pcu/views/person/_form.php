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
<div class="person-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'person_id')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'cid')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'pname')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'fname')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['readonly' => true]) ?>

    

    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
