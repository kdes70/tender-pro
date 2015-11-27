<?php

    use app\modules\admin\Module;
    use iutbay\yii2kcfinder\KCFinderInputWidget;

?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Settings', 'icon' => 'fa fa-wrench', 'url' => ['/admin/settings']],
                    ['label' => 'USERS MENU', 'options' => ['class' => 'header']],
                    [
                        'label' => Module::t('module', 'ADMIN_USERS'),
                        'icon' => 'fa fa-users',
                        'url' => '#',
                        'items' => [
                            ['label' => 'List Users', 'icon' => 'fa fa-user', 'url' => '/admin/users',],
                            ['label' => 'Create User', 'icon' => 'fa fa-user-plus', 'url' => '/admin/users/create',],
                        ],
                    ],
                    ['label' => 'BLOG MENU', 'options' => ['class' => 'header']],
                    [
                        'label' => Module::t('module', 'ADMIN_BLOG'),
                        'icon' => 'fa fa-laptop',
                        'url' => '#',
                        'items' => [
                            ['label' => 'List Blog', 'icon' => 'fa fa-book', 'url' => '/admin/blog'],
                            ['label' => 'List Category', 'icon' => 'fa fa-list-ul', 'url' => '/admin/blog-category'],
                        ]
                    ],
                    [
                        'label' => 'Same tools',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'fa fa-circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'fa fa-circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
