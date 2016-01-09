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

                <?php if(isset($blog_post)):?>

                    <?php  foreach ($blog_post as $model):?>
                        <?php echo $this->render('shortView', ['model' => $model]);?>
                    <?php endforeach;?>

                <?php endif;?>


                <!-- Pager -->
                <?php if(isset($pages)):?>
                <div class="pagination">
                    <ul class="pager">
                        <?php // display pagination
                            // echo LinkPager::widget([
                            //    'pagination' => $pages,
                            // ]);?>
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
                <div class="well">
                    <h4>Blog Search</h4>

                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>

                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.
                    </p>
                </div>

                <?php// echo $this->render('_sidebar.php')?>

            </div>


        </div>
    </div>
</div>


