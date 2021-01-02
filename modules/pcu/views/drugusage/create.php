<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\Drugusage */

$this->title = 'Create Drugusage';
$this->params['breadcrumbs'][] = ['label' => 'Drugusages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drugusage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
