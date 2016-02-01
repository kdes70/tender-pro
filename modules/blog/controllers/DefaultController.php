<?php

namespace app\modules\blog\controllers;

use Yii;
use app\modules\blog\models\Blog;
use app\modules\blog\models\BlogCategory;
use yii\data\Pagination;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $settings = Yii::$app->settings;

        $num_post = $settings->get('blog.number_posts');


        $query = Blog::getPublishedPosts();
        $countQuery = clone $query;
        $pages = new Pagination(['defaultPageSize' => $num_post,'totalCount' => $countQuery->count()]);

        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();




         //  var_dump($models);exit;

        return $this->render('index', [
            'blog_post' => $models,
            'pages' => $pages,
            'category' => BlogCategory::find()->where(['status' => BlogCategory::STATUS_PUBLISH])->all(),
            'action' => 'short',
        ]);
    }

    public function actionView($slug)
    {



        $model = new Blog();

        return $this->render('full_post', [
            'model' => $model->find()
                ->where(['slug' => $slug])
                ->one(),
            'action' => 'full',
        ]);
    }
}
