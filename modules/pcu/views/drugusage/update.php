<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\Drugusage */

$this->title = 'Update Drugusage: ' . $model->drugusage;
$this->params['breadcrumbs'][] = ['label' => 'Drugusages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->drugusage, 'url' => ['view', 'id' => $model->drugusage]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="drugusage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
