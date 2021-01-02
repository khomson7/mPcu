<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
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
              'allowGuests' => true,
              'allowSelfVote' => false,
              'entityAuthorAttribute' => 'user_id',
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
  ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
