<?php


use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->title = 'นำเข้าคัดกรองบุหรี่-สุรา จากโรงพยาบาล';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$form = ActiveForm::begin(['method' => 'get',
            'action' => Url::to(['default/opd1']),]);
?>
<div class='well'>   
        วันที่
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <?php
            echo yii\jui\DatePicker::widget([
                'name' => 'date1',
                'value' => $date1,
                'language' => 'th',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true,
                ],
                'options' => [
                    'class' => 'form-control'
                ],
            ]);
            ?>
            
        </div>  
        
        <div class="col-xs-4 col-sm-4 col-md-4">
            <?php
            echo yii\jui\DatePicker::widget([
                'name' => 'date2',
                'value' => $date2,
                'language' => 'th',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' => [
                    'changeMonth' => true,
                    'changeYear' => true,
                ],
                'options' => [
                    'class' => 'form-control'
                ],
            ]);
            ?>
            
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
            <button class='btn btn-danger'>ประมวลผล</button>
        </div>
    </div>
    <br>
<?php ActiveForm::end(); ?>
</div>