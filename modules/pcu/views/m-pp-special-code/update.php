<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MPpSpecialCode */

$this->title = 'Update M Pp Special Code: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'M Pp Special Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mpp-special-code-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
