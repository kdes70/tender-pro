<?php

    use app\components\grid\LinkColumn;
    use app\modules\blog\models\BlogCategory;
    use app\modules\user\models\User;
    use yii\grid\GridView;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use app\components\grid\SetColumn;
    use app\modules\blog\models\Blog;

    /* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Blog', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'options'   => ['width' => '50']
            ],
            [
                'filter' => ArrayHelper::map(BlogCategory::find()->all(), 'id', 'name'),
                'attribute' => 'category_id',
                'value' => 'category.name'
            ],
            [
                'filter' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
                'attribute' => 'user_id',
                'value' =>'user.username',
            ],
            [
                'class' => LinkColumn::className(),
                'attribute' => 'title',
                'value' => function($data)
                {
                    return  \yii\helpers\StringHelper::truncate($data->title,30,'...');
                },
                'options' => [
                    'width' => '250',
                    'title' => 'title'
                ]

            ],
            'slug',
            [
                'class' => SetColumn::className(),
                'filter' => Blog::getStatusesArray(),
                'attribute' => 'status',
                'name' => 'statusName',
                'cssCLasses' => [
                    Blog::STATUS_PUBLISH => 'success',
                    Blog::STATUS_UNPUBLISH => 'default',
                ],
            ],
            [
                'attribute' =>  'publication_at',
                'format' =>  ['date', 'd MMMM yyyy HH:mm'],
                //  'options' => ['width' => '200']
            ],
            // 'text:ntext',
            // 'prev_img',
            // 'images_id',
            // 'publication_at',
            // 'created_at',
            // 'updated_at',
            // 'status',
            // 'order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
