<?php

use yii\helpers\Html;
use app\assets\MainAsset;

MainAsset::register($this);

    /* @var $this \yii\web\View */
    /* @var $content string */

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
<head>

    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="img/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-touch-icon-114x114.png">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <meta name="description" content="">
    <!-- Header CSS (First Sections of Website: paste after release from _header.min.css here) -->
    <style></style>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<!-- Здесь пишем код -->

<header class="main-head" style="background-image: url('img/header-bg.jpg')">
    <div class="top-line">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-8">
                    <a href="/" class="logo"><span>$></span>webim</a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-4 col-lg-push-7 col-md-push-6">
                    <ul class="social">
                        <li class="vk"><a href="#"></a></li>
                        <li class="fb"><a href="#"></a></li>
                        <li class="tw"><a href="#"></a></li>
                    </ul>
                    <a href="#" id="menu" class="button toggle-menu hidden-lg hidden-md"><span></span></a>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-12 col-lg-pull-3 col-md-pull-3">
                    <nav class="top-menu">
                        <ul>
                            <li class="active"><a href="#">Главная</a></li>
                            <li><a href="#">Работы</a></li>
                            <li><a href="#">Контакты</a></li>
                            <li><?php echo Html::a(Yii::t('app', 'NAW_BLOG'), '/blog/default/index');?></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="header_wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 col-sm-12 col-xs-12 ">
                    <div class="hi-title">
                        <h1>Привет! меня зовут Дмитрий <br>я занимаюсь <span>веб-разработкой</span> сайтов и сервисов</h1>
                    </div>
                </div>
                <div class="col-lg-2"></div>

            </div>
        </div>





    </div>

    <div class="button-wrap">
        <div class="arrow_down"></div>
    </div>
</header>
<section class="main-section">
    <div class="container">
        <div class="row">



            <?php

            echo \app\modules\blog\components\widgets\BlogFeed::widget([
                'title' => 'Последние публикации',
                'item' => 2,
                'line' => 'horizontal' // or 'vertical'
            ]);


            ?>

        </div>
    </div>

</section>

<div class="hidden"></div>

<!-- Load CSS -->
<script>
    function loadCSS(hf) {
        var ms=document.createElement("link");ms.rel="stylesheet";
        ms.href=hf;document.getElementsByTagName("head")[0].appendChild(ms);
    }
    loadCSS("_header.min.css"); //Header Styles (compress & paste to header after release)
    loadCSS("_main.min.css");   //User Styles + Media Queries
</script>

<!-- Load Scripts -->
<script>var scr = {"scripts":[
//        {"src" : "js/libs.js", "async" : false},
        {"src" : "js/main.js", "async" : false}
    ]};!function(t,n,r){"use strict";var c=function(t){if("[object Array]"!==Object.prototype.toString.call(t))return!1;for(var r=0;r<t.length;r++){var c=n.createElement("script"),e=t[r];c.src=e.src,c.async=e.async,n.body.appendChild(c)}return!0};t.addEventListener?t.addEventListener("load",function(){c(r.scripts);},!1):t.attachEvent?t.attachEvent("onload",function(){c(r.scripts)}):t.onload=function(){c(r.scripts)}}(window,document,scr);
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>