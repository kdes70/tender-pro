<?php

    /**
     * @var $line string Напровления блоков
     */
?>

<?php if(isset($blog_feed)): ?>

<h2 class="main-title"><span><?php echo $title; ?></span></h2>

    <?php

    /**
     *  Отопбражаем шаблон в зависимости от значения $line
     */

    if($line === 'horizontal'):?>
        <?php  foreach ($blog_feed as $item) :?>
          <div class="col-md-4 col-sm-6 col-xs-12">
              <?php  echo $this->render('_shortFeed', ['model' => $item]); ?>
           </div>
        <?php endforeach;?>
    <?php else: ?>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?php  foreach ($blog_feed as $item) {
                echo $this->render('_shortFeed', ['model' => $item]);
            } ?>
        </div>
    <?php endif; ?>


<?php else: ?>
    <h2 class="main-title"><span>Нет записи в блоге</span></h2>

<?php endif; ?>