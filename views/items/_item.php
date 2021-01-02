<div class="item">
    <div class="item-content">
        <?= \yii\helpers\Html::encode($model->content) ?>
    </div>
    <div class="item-buttons'>
        <?= \hauntd\vote\widgets\Vote::widget([
            'entity' => 'itemVote',
            'model' => $model,
        ]); ?>
        <?= \hauntd\vote\widgets\Favorite::widget([
            'entity' => 'itemFavorite',
            'model' => $model,
        ]); ?>
    </div>
</div>