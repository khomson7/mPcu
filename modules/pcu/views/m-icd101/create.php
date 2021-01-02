<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MIcd101 */

$this->title = 'Create M Icd101';
$this->params['breadcrumbs'][] = ['label' => 'M Icd101s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="micd101-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
