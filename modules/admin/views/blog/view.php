<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Blog */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

        <div class="col-md-12">

             <div class="blog-post-preview">
                    <div style='transform-origin: 0 0; transform: scale(1); margin-bottom:-100px;'>
                        <iframe src='http://tender-pro.lok/blog/default/view?slug=<?php echo $model->slug; ?>' frameborder='0' scrolling='no' width='100%' height='600px'>
                            Your browser does not support iframes.
                        </iframe>
                    </div>
            </div>
        </div>
            <!--        <iframe src="http://tender-pro.lok/blog/default/index" width="100%" height="600px" seamless></iframe>-->




</div>






    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category.name',
            'user_id',
            'title',
            'slug',
            'text:ntext',
            'prev_img',
            'images_id',
            'publication_at',
            'created_at',
            'updated_at',
            'status',
            'order',
        ],
    ]) ?>

</div>
