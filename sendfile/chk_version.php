<?php

?>
<meta charset="UTF-8">
<style>
    .btn-xlarge {
        padding: 18px 28px;
        font-size: 22px; 
        line-height: normal;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
        cursor: pointer
    }
</style>
<script src="jquery.js"></script>
<script>
    $(function () {
       // alert();
    });

</script>

<table border="0">

    <tr style="background: green; color: white">
        <td>Current Version</td>
        <td>
            <?php
            echo file_get_contents("../version/version.txt");
            ?>
        </td>
    </tr>
    <tr style="background: blue; color: white">
        <td>Last Version</td>
        <td>
           
        </td>
    </tr>
</table> 

<hr>
<button id="update3" class="btn-xlarge">
    ปรับข้อมูลแพ้ยา
</button>

<div id="res" style="display: none">
    <img src="sending.gif">
</div>

<button id="update2" class="btn-xlarge">
    ส่งข้อมูล EPI
</button>

<div id="res" style="display: none">
    <img src="sending.gif">
</div>


<button id="update" class="btn-xlarge">
    ส่งข้อมูล Person
</button>

<div id="res" style="display: none">
    <img src="updating.gif">
</div>
<hr>
<div>
    
</div>
<script>
    function 
    update2() {
        $.ajax({
            url: "http://127.0.0.1/mPcu/web/index.php?r=f43file/default/epi",
            success: function () {
                $('#res').toggle();
              alert('ส่งข้อมูล EPI สำเร็จ');
            }
        });
    }
   
     $('#update2').on('click', function () {
        $('#res').toggle();
        $.ajax({
            url: "download.php",
            success: function (data) {
                update2();
            }
        });
    });
    
    function 
    update() {
        $.ajax({
            url: "http://127.0.0.1/mPcu/web/index.php?r=f43file/default/wscperson",
            success: function () {
                $('#res').toggle();
                alert('ส่งข้อมูล PERSON สำเร็จ');
            }
        });
    }
    $('#update').on('click', function () {
        $('#res').toggle();
        $.ajax({
            url: "download.php",
            success: function (data) {
                update();
            }
        });
    });
    
     function 
    update3() {
        $.ajax({
            url: "http://127.0.0.1/mPcu/web/index.php?r=f43file/default/opdallergy",
            success: function () {
                $('#res').toggle();
                alert('ปรับข้อมูลแพ้ยาสำเร็จ');
            }
        });
    }
    $('#update3').on('click', function () {
        $('#res').toggle();
        $.ajax({
            url: "download.php",
            success: function (data) {
                update3();
            }
        });
    });
</script>





