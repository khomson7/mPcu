<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HosBasedata */

$this->title = 'Create Hos Basedata';
$this->params['breadcrumbs'][] = ['label' => 'Hos Basedatas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hos-basedata-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
