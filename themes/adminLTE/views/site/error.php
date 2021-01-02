<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<section class="content">

    <div class="error-page">
        <h2 class="headline text-info"><i class="fa fa-warning text-yellow"></i></h2>

        <div class="error-content">
            <h3><?= $name ?></h3>

            <p>
                <?= nl2br(Html::encode($message)) ?>
            </p>

            <p>
                กรุณา Update  Verion เพื่อดูรายงาน
            </p>


         
        </div>
         <div class="row">       
                <div class="col-xs-12 col-sm-12 col-md-12">

                    

                    <h4>ตัวอย่างการ Update Version</h4>
                    <div>copy คำสั่งด้านล่าง ไปวางใน โปรแกรม Git แล้ว Enter <br>
                    
                    <h4>cd D:/xampp/htdocs/mPcu && git pull </h4> </div>
                    <br>

                    <img src="./images/git.jpg" alt="Mountain View" style="width:900px;height:500px;">
                    <br>
                    

                </div>
            </div>
    </div>

</section>
