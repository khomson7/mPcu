<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RcptArrear */

$this->title = $model->arrear_id;
$this->params['breadcrumbs'][] = ['label' => 'Rcpt Arrears', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rcpt-arrear-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->arrear_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->arrear_id], [
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
            'arrear_id',
            'vn',
            'arrear_date',
            'arrear_time',
            'amount',
            'staff',
            'rcpno',
            'finance_number',
            'paid',
            'pt_type',
            'hn',
            'receive_money_date',
            'receive_money_time',
            'receive_money_staff',
            'hos_guid',
            'an',
        ],
    ]) ?>

</div>
