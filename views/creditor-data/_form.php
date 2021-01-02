<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\CreditorType;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\CreditorData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="creditor-data-form">
  

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'order_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parties')->textInput(['maxlength' => true]) ?>

    
            
            <?=
            $form->field($model, 'type_id')->widget(Select2::className(), ['data' =>
                        ArrayHelper::map(CreditorType::find()->all(), 'id', 'creditor_type_name'),
                        'options' => [
                        'placeholder' => '<--กรุณาเลือกประเภทพัสดุ-->'],
                        'pluginOptions' =>
                        [
                            'allowClear' => true
                        ],
                    ]);
            ?>

    <?= $form->field($model, 'receiver_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
