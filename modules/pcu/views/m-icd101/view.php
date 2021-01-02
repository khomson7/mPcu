<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\pcu\models\MIcd101 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'M Icd101s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="micd101-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->code], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->code], [
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
            'code',
            'name',
            'spclty',
            'tname',
            'code3',
            'code4',
            'code5',
            'sex',
            'ipd_valid',
            'icd10compat',
            'icd10tmcompat',
            'active_status',
            'hos_guid',
            'hos_guid_ext',
        ],
    ]) ?>

</div>
