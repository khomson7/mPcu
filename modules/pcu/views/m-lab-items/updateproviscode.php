<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MLabItems */

$this->title = 'Update M Lab Items: ' . $model->lab_items_code;
$this->params['breadcrumbs'][] = ['label' => 'M Lab Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->lab_items_code, 'url' => ['view', 'id' => $model->lab_items_code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mlab-items-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
