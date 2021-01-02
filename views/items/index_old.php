<?= \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'layout' => '{items} {pager}',
    'itemView' => '_item',
]) ?>