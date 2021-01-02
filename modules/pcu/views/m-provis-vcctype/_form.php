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

<div class="mprovis-vcctype-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'hos_guid')->hiddenInput()->label(FALSE) ?>

    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
