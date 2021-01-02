<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MPpSpecialType */

$this->title = 'Update M Pp Special Type: ' . $model->pp_special_type_id;
$this->params['breadcrumbs'][] = ['label' => 'M Pp Special Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pp_special_type_id, 'url' => ['view', 'id' => $model->pp_special_type_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mpp-special-type-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
