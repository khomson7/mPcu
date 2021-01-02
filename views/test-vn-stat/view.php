<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TestVnStat */

$this->title = $model->vn;
$this->params['breadcrumbs'][] = ['label' => 'Test Vn Stats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-vn-stat-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->vn], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->vn], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'vn',
            'hn',
            'pttype',
            'vstdate',
        ],
    ]) ?>

</div>
