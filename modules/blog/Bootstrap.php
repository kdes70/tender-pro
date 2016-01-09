<?php

namespace app\modules\blog;

use yii\base\BootstrapInterface;
use Yii;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/blog/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/blog/messages',
            'fileMap' => [
                'modules/blog/module' => 'module.php',
            ],
        ];
    }
}