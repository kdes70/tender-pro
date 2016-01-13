<?php

namespace app\modules\user;

use yii\base\BootstrapInterface;
use Yii;

class Bootstrap implements BootstrapInterface
{
    /**
     *
     * @var string source language for translation
     */
    public $sourceLanguage = 'en-US';

    public function bootstrap($app)
    {
        $app->i18n->translations['modules/settings/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'sourceLanguage' => $this->sourceLanguage,
            'basePath' => '@app/modules/settings/messages',
            'fileMap' => [
                'modules/settings/module' => 'module.php',
            ],
        ];
    }
}