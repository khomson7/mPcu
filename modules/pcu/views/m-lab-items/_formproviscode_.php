<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MLabItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mlab-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lab_items_code')->textInput() ?>

    <?= $form->field($model, 'lab_items_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lab_type_code')->textInput() ?>

    <?= $form->field($model, 'lab_items_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lab_items_normal_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lab_items_hint')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lab_items_default_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lab_items_group')->textInput() ?>

    <?= $form->field($model, 'service_price')->textInput() ?>

    <?= $form->field($model, 'possible_value')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lab_routine')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lab_items_sub_group_code')->textInput() ?>

    <?= $form->field($model, 'require_specimen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'specimen_code')->textInput() ?>

    <?= $form->field($model, 'wait_hour')->textInput() ?>

    <?= $form->field($model, 'critical_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'display_order')->textInput() ?>

    <?= $form->field($model, 'ecode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'service_price2')->textInput() ?>

    <?= $form->field($model, 'service_price3')->textInput() ?>

    <?= $form->field($model, 'service_price_ipd')->textInput() ?>

    <?= $form->field($model, 'service_price_ipd2')->textInput() ?>

    <?= $form->field($model, 'service_price_ipd3')->textInput() ?>

    <?= $form->field($model, 'check_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_group_list')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'range_check')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'range_check_min')->textInput() ?>

    <?= $form->field($model, 'range_check_max')->textInput() ?>

    <?= $form->field($model, 'result_type')->textInput() ?>

    <?= $form->field($model, 'range_check_min_female')->textInput() ?>

    <?= $form->field($model, 'range_check_max_female')->textInput() ?>

    <?= $form->field($model, 'lab_items_code_guid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'service_cost')->textInput() ?>

    <?= $form->field($model, 'oldcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'items_is_outlab')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hos_guid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'report_edit_style')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'memo_line_count')->textInput() ?>

    <?= $form->field($model, 'alert_critical_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'critical_range_min_male')->textInput() ?>

    <?= $form->field($model, 'critical_range_min_female')->textInput() ?>

    <?= $form->field($model, 'critical_range_max_male')->textInput() ?>

    <?= $form->field($model, 'critical_range_max_female')->textInput() ?>

    <?= $form->field($model, 'confirm_order_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'loinc_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'check_result_by_age')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'check_history')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'check_history_day')->textInput() ?>

    <?= $form->field($model, 'lab_items_display_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hint_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'lab_critical_alert_type_id')->textInput() ?>

    <?= $form->field($model, 'active_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'labtest')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'protect_result_by_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'protect_result_by_group')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'explicit_show_hist_abn_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'provis_labcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alert_critical_value2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'critical_range_min_male2')->textInput() ?>

    <?= $form->field($model, 'critical_range_min_female2')->textInput() ?>

    <?= $form->field($model, 'critical_range_max_male2')->textInput() ?>

    <?= $form->field($model, 'critical_range_max_female2')->textInput() ?>

    <?= $form->field($model, 'gen_order_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gen_order_prefix')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'est_wait_minute')->textInput() ?>

    <?= $form->field($model, 'report_next_day')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'show_refer_doc')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
