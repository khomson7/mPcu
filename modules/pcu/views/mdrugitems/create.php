<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\Mdrugitems */

$this->title = 'Create Mdrugitems';
$this->params['breadcrumbs'][] = ['label' => 'Mdrugitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mdrugitems-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
