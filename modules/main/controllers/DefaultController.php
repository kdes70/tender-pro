<?php

namespace app\modules\main\controllers;

use Yii;
use app\components\Settings;
use yii\web\Controller;

class DefaultController extends Controller
{
    //public $layout = 'index';

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {   $this->layout = 'index';


       $settings = Yii::$app->settings;

        $value = $settings->get('blog.number_posts');


        dump($value);

        return $this->render('index');
    }
}
