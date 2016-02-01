<?php
        use yii\widgets\LinkPager;
        /* @var $this yii\web\View */
        $this->title = Yii::$app->name;
?>
<div class="blog-default-index">
    <div class="blog-header jumbotron" style="background-image: url('../../img/blog_header_bg.jpg')">
        <h1>Добро пожаловать!</h1>
        <p class="lead">Надеюсь вы найдете для себя много интерестного материала</p>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-md-8">

                <?php if(isset($blog_post)): ?>
                    <?php  foreach ($blog_post as $model):?>

                        <?php foreach ($model->getImages() as $image): ?>
                            <?php if($image):?>
                                <?php  $items[] = '<img class="img-responsive" src="' . $image->getUrl('750x200') . '" alt="">'; ?>
                            <?php endif;?>
                        <?php endforeach; ?>

                        <?php echo $this->render('_short_post', ['model' => $model, 'images' => $items]);?>

                    <?php endforeach;?>
                <?php endif;?>


                <!-- Pager -->
                <?php if(isset($pages)):?>
                <div class="pagination">
                    <ul class="pager">
                        <?php  //display pagination
                             echo LinkPager::widget([
                                'pagination' => $pages,
                             ]);?>
                        <!--                    <li class="previous">-->
                        <!--                        <a href="#">&larr; Older</a>-->
                        <!--                    </li>-->
                        <!--                    <li class="next">-->
                        <!--                        <a href="#">Newer &rarr;</a>-->
                        <!--                    </li>-->
                    </ul>

                </div>
                <?php endif; ?>

            </div>
            <!-- Blog Sidebar Widgets Column -->

            <div class="col-md-4">
                <!-- Blog Search Well -->

                <?php echo $this->render('_sidebar.php')?>

            </div>


        </div>
    </div>
</div>


