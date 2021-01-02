
<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Api Error';
$message = 'ท่านยังไม่เปิดใช้งาน Token / Api มีปัญหา';
?>
<div class="jumbotron">
      <h1><?=Html::img(Url::base().'/images/sql_error.png')?><?= Html::encode($this->title) ?></h1>
      <p class="text-danger"><?= nl2br(Html::encode($message)) ?></p>
      
</div>