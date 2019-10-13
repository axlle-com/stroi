<?php

use yii\helpers\Html;
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=Yii::$app->user->identity->username ?></p>

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
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Очистить кэш', 'icon' => 'refresh', 'url' => ['/site/cashes'],],
                    ['label' => 'Страница вывода', 'icon' => 'dashboard', 'url' => ['/render/index'],],
                    ['label' => 'Категории', 'icon' => 'file-code-o', 'url' => ['/category/index'],],
                    ['label' => 'Статьи', 'icon' => 'dashboard', 'url' => ['/item/index'],],
                    ['label' => 'Детали', 'icon' => 'dashboard', 'url' => ['/details/index'],],
                    ['label' => 'Связка деталей с типами', 'icon' => 'dashboard', 'url' => ['/details-has-type/index'],],



                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Материалы',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Типы', 'icon' => 'dashboard', 'url' => ['/type/index'],],
                            ['label' => 'Допы', 'icon' => 'dashboard', 'url' => ['/specifically/index'],],
                            ['label' => 'Наценка', 'icon' => 'dashboard', 'url' => ['/extra/index'],],
                            ['label' => 'Связка типов с допами', 'icon' => 'dashboard', 'url' => ['/type-has-specifically/index'],],
                            ['label' => 'Инфоблок', 'icon' => 'dashboard', 'url' => ['/infoblock/index'],],
                            ['label' => 'Связка статей с инфоблоками', 'icon' => 'dashboard', 'url' => ['/infoblock-has-item/index'],],
                            ['label' => 'Теги', 'icon' => 'dashboard', 'url' => ['/tags/index'],],
                            ['label' => 'Связка тегов со статьями', 'icon' => 'dashboard', 'url' => ['/tags-has-item/index'],],
                            ['label' => 'Фотогаллерея', 'icon' => 'dashboard', 'url' => ['/folder/index'],],
                            ['label' => 'Фотографии', 'icon' => 'dashboard', 'url' => ['/image/index'],],
                            ['label' => 'Связка галереи со статьей', 'icon' => 'dashboard', 'url' => ['/folder-has-item/index'],],
                            ['label' => 'СЕО дополнения', 'icon' => 'dashboard', 'url' => ['/semantico'],],
                            ['label' => 'Отзывы', 'icon' => 'dashboard', 'url' => ['/reviews'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    ['label' => 'Черный список', 'icon' => 'exclamation-triangle', 'url' => ['/ips'],],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                ],
            ]
        ) ?>

    </section>

</aside>
