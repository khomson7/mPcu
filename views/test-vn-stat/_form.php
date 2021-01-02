<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use hauntd\vote\widgets\Vote;
use kartik\widgets\StarRating;
use kartik\widgets\Alert;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Pttype;

/* @var $this yii\web\View */
/* @var $model app\models\TestVnStat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-vn-stat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vn')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'hn')->textInput(['readonly' => true]) ?>
    
     <?= $form->field($model, 'pttype')->textInput(['readonly' => true]) ?>
    
     <?= $form->field($model, 'vstdate')->textInput(['readonly' => true]) ?>
    
    <?=
            $form->field($pcl, 'pttype_new')->widget(Select2::className(), ['data' =>
                        ArrayHelper::map(Pttype::find()->all(), 'pttype', 'name'),
                        'options' => [
                        'placeholder' => '<--กรุณาเลือกสิทธ-->'],
                        'pluginOptions' =>
                        [
                            'allowClear' => true
                        ],
                    ]);
            ?>
    
  
    <?= $form->field($pcl, 'remark')->textarea(['rows' => 6]) ?>
   

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
