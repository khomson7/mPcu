<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MPpSpecialType */

$this->title = 'Create M Pp Special Type';
$this->params['breadcrumbs'][] = ['label' => 'M Pp Special Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpp-special-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
