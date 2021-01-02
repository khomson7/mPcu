<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MPersonVaccine */

$this->title = 'Create Mperson Vaccine';
$this->params['breadcrumbs'][] = ['label' => 'Mperson Vaccines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mperson-vaccine-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
