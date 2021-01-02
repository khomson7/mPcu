<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\WscPcuOapp */

$this->title = 'ปรับปรุงข้อมูล: ' . $model->id;

?>
<div class="wsc-pcu-oapp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
