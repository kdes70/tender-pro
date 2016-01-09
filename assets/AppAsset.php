<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'js/admin.js',
    ];
    public $depends = [
        'app\assets\Html5ShivAsset',
        'app\assets\RespondAsset',
        'hiqdev\assets\icheck\iCheckAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',

    ];
}
