<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MLabItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mlab-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lab_items_code')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'lab_items_name')->textInput(['readonly' => true]) ?>

 
    <?= $form->field($model, 'provis_labcode')->textInput(['readonly' => true]) ?>

   

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
