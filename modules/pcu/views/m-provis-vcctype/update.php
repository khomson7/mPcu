<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MProvisVcctype */

$this->title = 'Update Mprovis Vcctype: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mprovis Vcctypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mprovis-vcctype-update">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
