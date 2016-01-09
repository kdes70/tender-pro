<?php
use yii\bootstrap\Carousel;
?>
<!-- First Blog Post -->
<div class="short-blog-post">
    <h2><a href="/blog/view/<?=$model->slug?>"><?=$model->title?></a></h2>
    <p class="lead">by <a href="index.php"><?=$model->user_id?></a></p>
    <p><span class="glyphicon glyphicon-time"></span> <?php echo Yii::$app->formatter->asDate($model->publication_at, 'd MMMM yyyy');?></p>

<!--    --><?php //foreach ($model->getImages() as $image): ?>
<!--        --><?php //if($image):?>
<!--            --><?php // $items[] = '<img class="img-responsive" src="' . $image->getUrl('730x400') . '" alt="">'; ?>
<!--        --><?php //endif;?>
<!--    --><?php //endforeach; ?>
<!--    --><?php //if($items):?>
<!--        --><?//echo Carousel::widget([
//            'items' => $items,
//            'controls' => [
//                '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span>',
//                '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span>'
//            ]
//            // the item contains only the image
//            // $items,
//            // equivalent to the above
//            //  ['content' => ' <img class="img-responsive" src="http://placehold.it/900x300" alt="">'],
//            // the item contains both the image and the caption
////        [
////            'content' => ' <img class="img-responsive" src="http://placehold.it/900x300" alt="">',
////            'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
////            'options' => [],
////        ],
//
//        ]);?>
<!---->
<!--    --><?php //endif;?>

    <span class="label label-info"><?=$model->category->name ?></span>
    <!--    <img class="img-responsive" src="http://placehold.it/900x300" alt="">-->
    <p><?=  \yii\helpers\StringHelper::truncate($model->text,200,'...'); ?></p>
    <a class="btn btn-primary" href="/main/blog/show/<?=$model->id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

    <p>Теги:</p>
    <? if ($model->blogTags):?>
        <ul class="tags blue">
            <? foreach($model->blogTags as $tag):?>
                <li><a href="index.html"><?= $tag['name'];?> <span>31</span></a></li>
            <? endforeach;?>
        </ul>
    <? endif;?>

</div>


<!-- End Blog Post -->
