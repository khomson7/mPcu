<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Alert;
/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MLabItems */
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
<div class="mlab-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lab_items_code')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'lab_items_name')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'lab_type_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'lab_items_unit')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'lab_items_normal_value')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'lab_items_hint')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'lab_items_default_value')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'lab_items_group')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'service_price')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'possible_value')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'lab_routine')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'icode')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'lab_items_sub_group_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'require_specimen')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'specimen_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'wait_hour')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'critical_value')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'display_order')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'ecode')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'service_price2')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'service_price3')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'service_price_ipd')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'service_price_ipd2')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'service_price_ipd3')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'check_user')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'sub_group_list')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'range_check')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'range_check_min')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'range_check_max')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'result_type')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'range_check_min_female')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'range_check_max_female')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'lab_items_code_guid')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'service_cost')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'oldcode')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'items_is_outlab')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'hos_guid')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'report_edit_style')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'memo_line_count')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'alert_critical_value')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'critical_range_min_male')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'critical_range_min_female')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'critical_range_max_male')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'critical_range_max_female')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'confirm_order_text')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'loinc_code')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'check_result_by_age')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'check_history')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'check_history_day')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'lab_items_display_name')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'hint_text')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'lab_critical_alert_type_id')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'active_status')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'labtest')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'protect_result_by_user')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'protect_result_by_group')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'explicit_show_hist_abn_value')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'provis_labcode')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'alert_critical_value2')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'critical_range_min_male2')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'critical_range_min_female2')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'critical_range_max_male2')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'critical_range_max_female2')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'gen_order_no')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'gen_order_prefix')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'est_wait_minute')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'report_next_day')->hiddenInput()->label(FALSE) ?>

    <?= $form->field($model, 'show_refer_doc')->hiddenInput()->label(FALSE) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
