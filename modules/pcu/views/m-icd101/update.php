<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MIcd101 */

$this->title = 'Update M Icd101: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'M Icd101s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="micd101-update">

   
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
