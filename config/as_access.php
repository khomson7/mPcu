<?php

return [
    'class' => 'mdm\admin\components\AccessControl',
    'allowActions' => [
        'user/registration/resend',
        'user/registration/register',
        'pcu/mycount/*', //บันทึกแสดงหน้า dashboard
        'pcu/linesend/*',
        'pcu/default/utbl',
        'f43file/person/loginapi',
        'f43file/default/wscopipcu',
        'f43file/default/wscperson',
        'f43file/default/epi',
        'f43file/default/opdallergy',
        //'f43file/person/testroute',
        //  'f43file/person/wsc-death',
        // 'pcu',
        //'admin/*',
        'site/index',
        'site/*',
        'site/sendsuccess',
    //  'user/recovery/request',
    //   'user/*'
    // 'site/*',
    //  'user/security/logout'
    ]
];
