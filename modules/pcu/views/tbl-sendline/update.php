<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\TblSendline */

$this->title = 'Update Tbl Sendline: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Sendlines', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-sendline-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
