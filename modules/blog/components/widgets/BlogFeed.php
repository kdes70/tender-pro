<?php


namespace app\modules\blog\components\widgets;

use app\modules\blog\models\Blog;
use yii\bootstrap\Widget;

class BlogFeed extends Widget
{

    public $lineType = [
        'horizontal'   => 'horizontal',
        'vertical'  => 'vertical',
    ];

    public $title = '';

    public $item = 3;

    public $line = '';

    /**
     * @var array the options for rendering the close button tag.
     */
    public $closeButton = [];

    public function init()
    {
        parent::init();

       // $session = \Yii::$app->getSession();
       // $appendCss = isset($this->options['class']) ? ' ' . $this->options['class'] : '';

        $this->line = in_array($this->line , $this->lineType) ? $this->line : 'horizontal';
    }

    public function run()
    {
        $model = new Blog();
        $blog_feed = $model->getBlogFeed($this->item);


        return $this->render('blog_feed',
            [
                'blog_feed' => $blog_feed,
                'title'     => $this->title,
                'line' => $this->line,
            ]);
    }
}