<?php

use yii\helpers\ArrayHelper;

$params = ArrayHelper::merge(
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

    // получаем список директорий в /modules
    $dirs = scandir(dirname(__FILE__).'/../modules');

    // строим массив
    $modules = array();
    foreach ($dirs as $name){
        if ($name[0] != '.')
            $modules[$name] = array('class'=>'app\modules\\' . $name . '\\' .'Module');
    }


    // строка вида 'news|page|user|...|socials'
    // пригодится для подстановки в регулярные выражения общих правил маршрутизации
    define('MODULES_MATCHES', implode('|', array_keys($modules)));

   // dump($mod);



return [
    'name' => 'SeoKeys',
    'language'=>'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'app\modules\admin\Bootstrap',
        'app\modules\main\Bootstrap',
        'app\modules\user\Bootstrap',
        'app\modules\blog\Bootstrap',
    ],
    'modules' => array_replace($modules,[
//        'settings' => [
//            'class' => 'pheme\settings\Module',
//        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'main',
        ],
        'yii2images' => [
            'class' => 'rico\yii2images\Module',
            //be sure, that permissions ok
            //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
            'imagesStorePath' => 'upload/store', //path to origin images
            'imagesCachePath' => 'upload/cache', //path to resized copies
            'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
            'placeHolderPath' => '@webroot/images/placeHolder.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
        ],
    ]),
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'charset' => 'utf8',
        ],
        'settings' => ['class' => 'app\component\Settings'],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'main/default/index',
                'contact' => 'main/contact/index',
                '<_a:error>' => 'main/default/<_a>',
                '<_a:(login|logout|signup|email-confirm|password-reset-request|password-reset)>' => 'user/default/<_a>',

                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/view',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
                '<_m:[\w\-]+>' => '<_m>/default/index',
                '<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>/index',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => ['user', 'admin'],
            'itemFile' => '@app/rbac/data/items.php',
            'assignmentFile' => '@app/rbac/data/assignments.php',
            'ruleFile' => '@app/rbac/data/rules.php'
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true,
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
        'cache' => [
            'class' => 'yii\caching\DummyCache',
        ],
        'log' => [
            'class' => 'yii\log\Dispatcher',
        ],
    ],
    'params' => $params,
];