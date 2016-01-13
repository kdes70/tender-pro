<?php

namespace app\modules\settings;

use Yii;
use yii\console\Application as ConsoleApplication;

/**
 * @author Aris Karageorgos <aris@phe.me>
 */
class Module extends \yii\base\Module
{
    /**
     * @var string The controller namespace to use
     */
    public $controllerNamespace = 'app\modules\settings\controllers';

    public function init()
    {
        parent::init();
//        if (Yii::$app instanceof ConsoleApplication) {
//            $this->controllerNamespace = 'app\modules\settings\commands';
//        }
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/user/' . $category, $message, $params, $language);
    }
}