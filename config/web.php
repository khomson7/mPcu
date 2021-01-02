<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/serv_config/db.php';
$db2 = require __DIR__ . '/dbhos.php';
//$db3 = require __DIR__ . '/../web/serv_config/dbserv.php';
/* เรียกใช้งาน จาก as_access.php*/
$as_access = require __DIR__ . '/as_access.php';

$config = [
    'id' => 'basic',
    'name' => 'mPcu',
    'language' => 'th-TH',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'chiliec\vote\components\VoteBootstrap'],
    'timeZone' => 'Asia/Bangkok',
    'charset' => 'utf-8',
    /* 'layout' => 'adminlte',  */
    'homeUrl' => '/mPcu/web',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'view'=>[
            'theme'=>[
                'pathMap'=>[
                    '@app/views'=>'@app/themes/adminLTE/views'
                ]
            ]
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '71lOYtjVPACDcmLzvC_ozSed1_SNqfPa',
        ],
        'authManager' => [
            'class' => 'dektrium\rbac\components\DbManager'
        ],
        /*
          'view' => [
          'theme' => [
          'pathMap' => [
          '@app/views' => '@app/themes/adminLTE/views'
          ]
          ]
          ], */
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        /*
          'user' => [
          'identityClass' => 'app\models\User',
          'enableAutoLogin' => true,
          ],
         */
        'user' => [
            //'identityClass' => 'app\models\User',
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 3600 * 60,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'db2' => $db2,
      //  'db3' => $db3,
       /*
        'db2' => [
            'class' => 'yii\db\Connection',
            'dsn' => $dns,
            'username' => $username,
            'password' => $password,
            'charset' => 'utf8',
        ],
        */
         
    /*
      'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
      ],
      ],
     */
    ],
    'modules' => [
        'vote' => [
            'class' => hauntd\vote\Module::class,
            'guestTimeLimit' => 3600,
            'entities' => [
                // Entity -> Settings
                'itemVote' => app\models\Item::class, // your model
                'itemVoteGuests' => [
                    'modelName' => app\models\Item::class, // your model
                // 'allowGuests' => true,
                //'allowSelfVote' => false,
                // 'entityAuthorAttribute' => 'user_id',
                ],
                'itemLike' => [
                    'modelName' => app\models\Item::class, // your model
                    'type' => hauntd\vote\Module::TYPE_TOGGLE, // like/favorite button
                ],
                'itemFavorite' => [
                    'modelName' => app\models\Item::class, // your model
                    'type' => hauntd\vote\Module::TYPE_TOGGLE, // like/favorite button
                ],
            ],
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        
        'user' => [
            'class' => 'dektrium\user\Module',
            'mailer' => [
                'sender' => 'no-reply@myhost.com', // or ['no-reply@myhost.com' => 'Sender name']
                'welcomeSubject' => 'Welcome subject',
                'confirmationSubject' => 'Confirmation subject',
                'reconfirmationSubject' => 'Email change subject',
                'recoverySubject' => 'Recovery subject',
            ],
            'enableConfirmation' => false,
            'cost' => 12,
            'admins' => ['khom']
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu'
        ],
        'pcu' => [
            'class' => 'app\modules\pcu\Pcu',

        ],
          'pcureport' => [
            'class' => 'app\modules\pcureport\Pcureport',

        ],
         'f43file' => [
            'class' => 'app\modules\f43file\Module',

        ],
        'vote' => [
            'class' => 'chiliec\vote\Module',
            // show messages in popover
            'popOverEnabled' => true,
            // global values for all models
            // 'allowGuests' => true,
            // 'allowChangeVote' => true,
            'models' => [
            // example declaration of models
            // \common\models\Post::className(),
            // 'backend\models\Post',
            // 2 => 'frontend\models\Story',
            // 3 => [
            //     'modelName' => \backend\models\Mail::className(),
            //     you can rewrite global values for specific model
            //     'allowGuests' => false,
            //  'allowChangeVote' => false,
            // ],
            ],
        ],
    ],
    /*
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'user/registration/resend',
           'user/registration/register',
            'pcu/mycount/*', //บันทึกแสดงหน้า dashboard
            'pcu/mycount',
       //'admin/*',
            'site/index',
            'site/sendsuccess',
         //  'user/recovery/request',
        //   'user/*'
        // 'site/*',
         
        //  'user/security/logout'
        ]
    ],
    
    */
    /* ดึงจาก $as_access = require __DIR__ . '/as_access.php'; */
    'as access' => $as_access,
    
    'params' => $params,
];

if (YII_ENV_DEV) {
    /*
      // configuration adjustments for 'dev' environment
      $config['bootstrap'][] = 'debug';
      $config['modules']['debug'] = [
      'class' => 'yii\debug\Module',
      // uncomment the following to add your IP if you are not connecting from localhost.
      //'allowedIPs' => ['127.0.0.1', '::1'],
      ]; */

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
