<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HosBasedata */

$this->title = 'Update Hos Basedata: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hos Basedatas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hos-basedata-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
