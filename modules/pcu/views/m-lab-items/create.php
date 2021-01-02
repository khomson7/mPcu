<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MLabItems */

$this->title = 'Create M Lab Items';
$this->params['breadcrumbs'][] = ['label' => 'M Lab Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mlab-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
