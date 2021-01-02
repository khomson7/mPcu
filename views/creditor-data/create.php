<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CreditorData */

$this->title = 'บันทึกรายการ';
$this->params['breadcrumbs'][] = ['label' => 'Creditor Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="creditor-data-create">

    <div class="box box-success box-solid">
    <div class="box-header">
        <h3 class="box-title"><i class="glyphicon glyphicon-film"></i> <?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
    </div>