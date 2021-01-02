<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MLabItemsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mlab-items-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'lab_items_code') ?>

    <?= $form->field($model, 'lab_items_name') ?>

    <?= $form->field($model, 'lab_type_code') ?>

    <?= $form->field($model, 'lab_items_unit') ?>

    <?= $form->field($model, 'lab_items_normal_value') ?>

    <?php // echo $form->field($model, 'lab_items_hint') ?>

    <?php // echo $form->field($model, 'lab_items_default_value') ?>

    <?php // echo $form->field($model, 'lab_items_group') ?>

    <?php // echo $form->field($model, 'service_price') ?>

    <?php // echo $form->field($model, 'possible_value') ?>

    <?php // echo $form->field($model, 'lab_routine') ?>

    <?php // echo $form->field($model, 'icode') ?>

    <?php // echo $form->field($model, 'lab_items_sub_group_code') ?>

    <?php // echo $form->field($model, 'require_specimen') ?>

    <?php // echo $form->field($model, 'specimen_code') ?>

    <?php // echo $form->field($model, 'wait_hour') ?>

    <?php // echo $form->field($model, 'critical_value') ?>

    <?php // echo $form->field($model, 'display_order') ?>

    <?php // echo $form->field($model, 'ecode') ?>

    <?php // echo $form->field($model, 'service_price2') ?>

    <?php // echo $form->field($model, 'service_price3') ?>

    <?php // echo $form->field($model, 'service_price_ipd') ?>

    <?php // echo $form->field($model, 'service_price_ipd2') ?>

    <?php // echo $form->field($model, 'service_price_ipd3') ?>

    <?php // echo $form->field($model, 'check_user') ?>

    <?php // echo $form->field($model, 'sub_group_list') ?>

    <?php // echo $form->field($model, 'range_check') ?>

    <?php // echo $form->field($model, 'range_check_min') ?>

    <?php // echo $form->field($model, 'range_check_max') ?>

    <?php // echo $form->field($model, 'result_type') ?>

    <?php // echo $form->field($model, 'range_check_min_female') ?>

    <?php // echo $form->field($model, 'range_check_max_female') ?>

    <?php // echo $form->field($model, 'lab_items_code_guid') ?>

    <?php // echo $form->field($model, 'service_cost') ?>

    <?php // echo $form->field($model, 'oldcode') ?>

    <?php // echo $form->field($model, 'items_is_outlab') ?>

    <?php // echo $form->field($model, 'hos_guid') ?>

    <?php // echo $form->field($model, 'report_edit_style') ?>

    <?php // echo $form->field($model, 'memo_line_count') ?>

    <?php // echo $form->field($model, 'alert_critical_value') ?>

    <?php // echo $form->field($model, 'critical_range_min_male') ?>

    <?php // echo $form->field($model, 'critical_range_min_female') ?>

    <?php // echo $form->field($model, 'critical_range_max_male') ?>

    <?php // echo $form->field($model, 'critical_range_max_female') ?>

    <?php // echo $form->field($model, 'confirm_order_text') ?>

    <?php // echo $form->field($model, 'loinc_code') ?>

    <?php // echo $form->field($model, 'check_result_by_age') ?>

    <?php // echo $form->field($model, 'check_history') ?>

    <?php // echo $form->field($model, 'check_history_day') ?>

    <?php // echo $form->field($model, 'lab_items_display_name') ?>

    <?php // echo $form->field($model, 'hint_text') ?>

    <?php // echo $form->field($model, 'lab_critical_alert_type_id') ?>

    <?php // echo $form->field($model, 'active_status') ?>

    <?php // echo $form->field($model, 'labtest') ?>

    <?php // echo $form->field($model, 'protect_result_by_user') ?>

    <?php // echo $form->field($model, 'protect_result_by_group') ?>

    <?php // echo $form->field($model, 'explicit_show_hist_abn_value') ?>

    <?php // echo $form->field($model, 'provis_labcode') ?>

    <?php // echo $form->field($model, 'alert_critical_value2') ?>

    <?php // echo $form->field($model, 'critical_range_min_male2') ?>

    <?php // echo $form->field($model, 'critical_range_min_female2') ?>

    <?php // echo $form->field($model, 'critical_range_max_male2') ?>

    <?php // echo $form->field($model, 'critical_range_max_female2') ?>

    <?php // echo $form->field($model, 'gen_order_no') ?>

    <?php // echo $form->field($model, 'gen_order_prefix') ?>

    <?php // echo $form->field($model, 'est_wait_minute') ?>

    <?php // echo $form->field($model, 'report_next_day') ?>

    <?php // echo $form->field($model, 'show_refer_doc') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
