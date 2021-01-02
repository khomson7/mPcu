<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\WscPcuOapp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wsc-pcu-oapp-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <?=
                $form->field($model, 'date_app')->widget(
                        DatePicker::className(), [
                    'name' => 'date_app',
                    //'value' => date('yyyy-mm-dd', strtotime('+2 days')),
                    'options' => ['placeholder' => 'เลือกวันที่'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);
                ?>
            </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <?= $form->field($model, 'result')->textInput() ?>
        </div>

    </div>
    <div>
            <?= $form->field($model, 'remark')->textarea() ?>
        </div>
    

    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
