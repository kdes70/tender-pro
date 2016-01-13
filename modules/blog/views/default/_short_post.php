<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Carousel;
use yii\helpers\StringHelper;
?>

<div class="short-blog-post">
<h2>

    <?php echo Html::a(Html::encode($model->title), Url::to(['view', 'slug' =>$model->slug]));?>
</h2>
<!-- TODO Author show? -->
<!--<p class="lead">-->
<!--    by <a href="index.php">Start Bootstrap</a>-->
<!--</p>-->
<p><span class="glyphicon glyphicon-time"></span> <?php echo Yii::$app->formatter->asDate($model->publication_at, 'd MMMM yyyy');?></p>

<? if ($model->blogTags):?>
<div class="blog-tags">
    <p>Теги:</p>
        <ul class="tags blue">
            <? foreach($model->blogTags as $tag):?>
                <li><a href="index.html"><?= $tag['name'];?> <span>31</span></a></li>
            <? endforeach;?>
        </ul>

</div>
<? endif;?>
<hr>

<?php if($images):?>
    <?echo Carousel::widget([
        'items' => $images,
        'controls' => [
            '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span>',
            '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span>'
        ]
        // the item contains only the image
        // $items,
        // equivalent to the above
        //  ['content' => ' <img class="img-responsive" src="http://placehold.it/900x300" alt="">'],
        // the item contains both the image and the caption
//        [
//            'content' => ' <img class="img-responsive" src="http://placehold.it/900x300" alt="">',
//            'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
//            'options' => [],
//        ],

    ]);?>

<?php endif;?>
<!--<img class="img-responsive" src="http://placehold.it/900x300" alt="">-->
<hr>

<!--<p>--><?php //echo  StringHelper::truncateWords($model->text, 100); ?><!--</p>-->
<p class="short-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid cum debitis eos esse fugit impedit incidunt iusto modi nobis non placeat quia quibusdam sapiente sequi soluta, tempora ullam voluptate. Quis.</p>

<a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

<hr>
</div>