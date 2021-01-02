<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MDttm */

$this->title = 'Update M Dttm: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'M Dttms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mdttm-update">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
