<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\TblToken */

$this->title = 'Update Tbl Token: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Tokens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'token_' => $model->token_]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-token-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
