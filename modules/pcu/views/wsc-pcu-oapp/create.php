<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\WscPcuOapp */

$this->title = 'บันทึกรายการนัด';
$this->params['breadcrumbs'][] = ['label' => 'บันทึกรายการนัด', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wsc-pcu-oapp-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
