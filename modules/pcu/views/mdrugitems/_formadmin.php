<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use hauntd\vote\widgets\Vote;
use kartik\widgets\StarRating;
use kartik\widgets\Alert;
use kartik\checkbox\CheckboxX;
?>

<?php
echo Alert::widget([
    'type' => Alert::TYPE_DANGER,
    'title' => 'Note: ',
    'titleOptions' => ['icon' => 'info-sign'],
    'body' => 'เอาเครื่องหมาย / หลัง สถานะการมีใช้ใน รพ.สต. ออกหากยานี้ไม่มีใช้ใน รพ.สต.'
]);
?>

<div class="mdrugitems-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'icode')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'strength')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'units')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'unitprice')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'dosageform')->hiddenInput()->label(FALSE) ?>

      <div><font color="orange">
        <?php
        echo $form->field($model, 'check_status')->widget(CheckboxX::classname(), [
            'pluginOptions' => ['threeState' => false],
        ])->label('สถานะมีใช้ใน รพ.สต.');
        ?>
        </font></div>
    


    <div class="form-group">
    <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
