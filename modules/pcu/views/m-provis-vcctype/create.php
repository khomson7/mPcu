<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MProvisVcctype */

$this->title = 'Create Mprovis Vcctype';
$this->params['breadcrumbs'][] = ['label' => 'Mprovis Vcctypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mprovis-vcctype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
