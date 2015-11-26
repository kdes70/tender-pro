<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\BlogTagsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blog Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-tags-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Blog Tags', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'frequency',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
