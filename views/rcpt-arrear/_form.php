<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use hauntd\vote\widgets\Vote;
use kartik\widgets\StarRating;
use kartik\widgets\Alert;
?>

<?php echo Alert::widget([
	'type' => Alert::TYPE_INFO,
	'title' => 'Note',
	'titleOptions' => ['icon' => 'info-sign'],
	'body' => 'This is an informative alert'
]); ?>

<div class="rcpt-arrear-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'arrear_id')->hiddenInput()->label(FALSE) ?>


    

    <?= $form->field($model, 'vn')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'arrear_date')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'arrear_time')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'staff')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'rcpno')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'finance_number')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'paid')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'pt_type')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'hn')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'receive_money_date')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'receive_money_time')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'receive_money_staff')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'hos_guid')->hiddenInput()->label(FALSE) ?>

        <?= $form->field($model, 'an')->hiddenInput()->label(FALSE) ?>

    <div class="form-group">
    <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>


