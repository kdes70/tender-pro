<?php

    namespace app\assets;

    use yii\web\AssetBundle;


    class WowjsAsset extends AssetBundle
    {
        public $sourcePath = '@bower/wowjs';

        public $css = [
            'css/libs/animate.css',
        ];
        public $js = [
            'dist/wow.min.js',
        ];
        public $jsOptions = [

        ];
    }

