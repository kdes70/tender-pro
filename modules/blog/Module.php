<?php

namespace app\modules\blog;
use Yii;
use yii\console\Application as ConsoleApplication;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\blog\controllers';

    public function init()
    {
        parent::init();
        if (Yii::$app instanceof ConsoleApplication) {
            $this->controllerNamespace = 'app\modules\blog\commands';
        }
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/blog/' . $category, $message, $params, $language);
    }
}
