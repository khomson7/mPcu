<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HosBasedata */
/* @var $form yii\widgets\ActiveForm */
?>
<?= \hauntd\vote\widgets\Favorite::widget([
    'entity' => 'itemFavorite',
    'model' => $model,
]); ?>

<?= \hauntd\vote\widgets\Like::widget([
    'entity' => 'itemLike',
    'model' => $model,
]); ?>
<div class="hos-basedata-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'base_data')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->dropDownList([ 'True' => 'True', 'False' => 'False', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'count_report')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
