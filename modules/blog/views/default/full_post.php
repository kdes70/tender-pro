<?php
    use yii\widgets\LinkPager;
    use yii\helpers\Html;
    /* @var $this yii\web\View */
    $this->title = Yii::$app->name;
?>
<div class="blog-default-index">
    <div class="container">
        <div class="row">

            <div class="col-md-8">

                <div class="blog-full-post">
                    <h2><?php echo Html::encode($model->title); ?></h2>
                </div>

            </div>
            <!-- Blog Sidebar Widgets Column -->

            <div class="col-md-4">
                <!-- Blog Search Well -->

                <?php echo $this->render('_sidebar.php')?>

            </div>


        </div>
    </div>
</div>


