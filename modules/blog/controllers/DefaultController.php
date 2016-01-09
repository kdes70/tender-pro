<?php

namespace app\modules\blog\controllers;

use yii\web\Controller;
use app\modules\blog\models\Blog;
use app\modules\blog\models\BlogCategory;
use yii\data\Pagination;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $query = Blog::getPublishedPosts();
        $countQuery = clone $query;
        $pages = new Pagination(['defaultPageSize' => 3,'totalCount' => $countQuery->count()]);

        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

         //  var_dump($models);exit;

        return $this->render('index', [
            'blog_post' => $models,
            'pages' => $pages,
            'category' => BlogCategory::find()->where(['status' => BlogCategory::STATUS_PUBLISH])->all(),
        ]);
    }
}
