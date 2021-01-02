<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MDttm */

$this->title = 'Create M Dttm';
$this->params['breadcrumbs'][] = ['label' => 'M Dttms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mdttm-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
