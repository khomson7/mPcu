<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TestVnStat */

$this->title = 'Create Test Vn Stat';
$this->params['breadcrumbs'][] = ['label' => 'Test Vn Stats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-vn-stat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
