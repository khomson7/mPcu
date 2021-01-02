<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MOpdAllergy */

$this->title = 'Update Mopd Allergy: ' . $model->hn;
$this->params['breadcrumbs'][] = ['label' => 'Mopd Allergies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->hn, 'url' => ['view', 'hn' => $model->hn, 'agent' => $model->agent]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mopd-allergy-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
