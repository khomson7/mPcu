<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TestVnStat */

$this->title = 'Update Test Vn Stat: ' . $model->vn;
$this->params['breadcrumbs'][] = ['label' => 'บันทึกเปลี่ยนแปลงสิทธ', 'url' => ['index']];

$this->params['breadcrumbs'][] = 'Update';
?>
<div class="test-vn-stat-update">

   

    <?= $this->render('_form', [
        'model' => $model,
        'pcl' => $pcl,
    ]) ?>

</div>
