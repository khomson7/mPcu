<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RcptArrear */

$this->title = 'Create Rcpt Arrear';
$this->params['breadcrumbs'][] = ['label' => 'Rcpt Arrears', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rcpt-arrear-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
