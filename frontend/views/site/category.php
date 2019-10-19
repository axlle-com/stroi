<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\components\Common;
use yii\helpers\Url;

$request_page = Yii::$app->request->get(trim('page'));
$request_page = (int)$request_page;
$request_sort = Yii::$app->request->get(trim('sort'));
if($request_page && $request_page != 1){
    $title = $category->title.'. Страница - '.$request_page;
    $title_seo = $category->title_seo.'. Страница - '.$request_page;
    $description_seo = $category->description_seo.'. Страница - '.$request_page;
}else{
    $title = $category->title;
    $description = $category->description;
    $title_seo = $category->title_seo;
    $description_seo = $category->description_seo;
}
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::to('@web/'.$category->alias_category.'.htm', true)]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $description_seo,
]);
$this->title = $title_seo;
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="container">
        <div class="row">
<!-- content --><?php
            if($this->beginCache('category',[
                'variations' => [$category->alias_category.$request_sort.$request_page],
                'duration' => 0,
            ])):?>
            <div class="col-md-9 col-md-push-3">
                <div class="heading-block page-wrapper" itemscope itemtype="http://schema.org/Product">
                    <div class="row"><div class="col-md-12"><h1 id="sort" class="title-underblock custom" itemprop="name"><?=$title?></h1></div></div>
                    <div itemprop="description" style="display: none"><?=$description_seo?></div>
                    <div itemtype="http://schema.org/AggregateOffer" itemscope="" itemprop="offers" style="display: none">
                        <meta content="<?= $max ?>" itemprop="highPrice"><!-- Высшая цена -->
                        <meta content="<?= $min ?>" itemprop="lowPrice"><!-- Низшая цена -->
                        <meta content="RUB" itemprop="priceCurrency"><!-- Валюта -->
                    </div>
                </div>
                <?php
                    $alias_category = Yii::$app->request->get(trim('alias_category'));
                    $request_tags = Yii::$app->request->get(trim('alias_tags'));
                    $tags = Common::getTag($alias_category);
                ?>
                <?php if($tags){?>
                    <div class="row tags">
                        <div class="col-md-12">
                            <?php if($tags['size']){?>
                                <div class="row tags-group">
                                    <div class="col-sm-4"><h5>Размер:</h5></div>
                                    <div class="col-sm-8">
                                        <?php foreach($tags['size'] as $row):?>
                                            <?php if($row->alias_tags == $request_tags){?>
                                                <div class="tags-active"><span><?=$row->title_short?></span><a href="<?=Url::to(['/'.$row->alias_category])?>" class=""><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></a></div>
                                            <?php }else{?>
                                                <a href="<?=Url::to(['/'.$row->alias_category.'/'.$row->alias_tags])?>" class="btn btn-custom2 btn-border btn-sm"><?=$row->title_short?></a>
                                            <?php }?>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            <?php }?>
                            <?php if($tags['square']){?>
                                <div class="row tags-group">
                                    <div class="col-sm-4"><h5>Площадь:</h5></div>
                                    <div class="col-sm-8">
                                        <?php foreach($tags['square'] as $row):?>
                                            <?php if($row->alias_tags == $request_tags){?>
                                                <div class="tags-active"><span><?=$row->title_short?></span><a href="<?=Url::to(['/'.$row->alias_category])?>" class=""><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></a></div>
                                            <?php }else{?>
                                                <a href="<?=Url::to(['/'.$row->alias_category.'/'.$row->alias_tags])?>" class="btn btn-custom2 btn-border btn-sm"><?=$row->title_short?></a>
                                            <?php }?>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            <?php }?>
                            <?php if($tags['features']){?>
                                <div class="row tags-group">
                                    <div class="col-sm-4"><h5>Конструктивные особенности:</h5></div>
                                    <div class="col-sm-8">
                                        <?php foreach($tags['features'] as $row):?>
                                            <?php if($row->alias_tags == $request_tags){?>
                                                <div class="tags-active"><span><?=$row->title_short?></span><a href="<?=Url::to(['/'.$row->alias_category])?>" class=""><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></a></div>
                                            <?php }else{?>
                                                <a href="<?=Url::to(['/'.$row->alias_category.'/'.$row->alias_tags])?>" class="btn btn-custom2 btn-border btn-sm"><?=$row->title_short?></a>
                                            <?php }?>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            <?php }?>
                            <?php if($tags['price']){?>
                                <div class="row tags-group">
                                    <div class="col-sm-4"><h5>Стоимость:</h5></div>
                                    <div class="col-sm-8">
                                        <?php foreach($tags['price'] as $row):?>
                                            <?php if($row->alias_tags == $request_tags){?>
                                                <div class="tags-active"><span><?=$row->title_short?></span><a href="<?=Url::to(['/'.$row->alias_category])?>" class=""><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></a></div>
                                            <?php }else{?>
                                                <a href="<?=Url::to(['/'.$row->alias_category.'/'.$row->alias_tags])?>" class="btn btn-custom2 btn-border btn-sm"><?=$row->title_short?></a>
                                            <?php }?>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            <?php }?>
                            <?php if($tags['floor']){?>
                                <div class="row tags-group">
                                    <div class="col-sm-4"><h5>Этажность:</h5></div>
                                    <div class="col-sm-8">
                                        <?php foreach($tags['floor'] as $row):?>
                                            <?php if($row->alias_tags == $request_tags){?>
                                                <div class="tags-active"><span><?=$row->title_short?></span><a href="<?=Url::to(['/'.$row->alias_category])?>" class=""><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></a></div>
                                            <?php }else{?>
                                                <a href="<?=Url::to(['/'.$row->alias_category.'/'.$row->alias_tags])?>" class="btn btn-custom2 btn-border btn-sm"><?=$row->title_short?></a>
                                            <?php }?>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            <?php }?>
                            <?php if($tags['type']){?>
                                <div class="row tags-group">
                                    <div class="col-sm-4"><h5>Тип постройки:</h5></div>
                                    <div class="col-sm-8">
                                        <?php foreach($tags['type'] as $row):?>
                                            <?php if($row->alias_tags == $request_tags){?>
                                                <div class="tags-active"><span><?=$row->title_short?></span><a href="<?=Url::to(['/'.$row->alias_category])?>" class=""><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></a></div>
                                            <?php }else{?>
                                                <a href="<?=Url::to(['/'.$row->alias_category.'/'.$row->alias_tags])?>" class="btn btn-custom2 btn-border btn-sm"><?=$row->title_short?></a>
                                            <?php }?>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                <?php }?>
                <div class="row">
                    <div class="col-md-12 sort">
                        <span class="sort-title">Сортировка:</span>
                        <?php if($request_sort == 'price-asc' || !$request_sort || $request_sort != 'price-desc'){?>
                            <span data-link-sort="<?=Url::to(['/'.$category->alias_category, 'sort' => 'price-desc', '#' => 'sort'])?>" class="sort-name" title="Цена по возрастанию" >По цене<i class="fa fa-sort-amount-asc"></i></span>
                        <?php }elseif ($request_sort == 'price-desc'){?>
                            <span data-link-sort="<?=Url::to(['/'.$category->alias_category, '#' => 'sort'])?>" class="sort-name" title="Цена по убыванию" >По цене<i class="fa fa-sort-amount-desc"></i></span>
                        <?php }?>
                    </div>
                </div>
                <?php if(!count($model)){}else{?>
                    <?php
                    $count = 1;
                    $teg_row = '<div class="row">';
                    $teg_div = '</div><!-- End .row -->';
                    ?>
                    <?php foreach($model as $row):?>
                    <?php if($count == 1 || $count%2 != 0)
                        echo $teg_row;
                    ?>
                    <div class="col-sm-6">
                        <div class="product text-center"><!-- Product -->
                            <div class="product-top">
                                <span class="product-box discount-box discount-box-border">-10%</span>
                                <figure>
                                    <a href="<?=Common::createdLink($row)?>" title="<?=$row->title?>">
                                        <?php if($img = Common::showGeneralImage($row)[0])
                                        {?>
                                            <img src="/images/<?=$row->getFolder().'/'.$row->alias_item?>/general/small_<?=$img?>" alt="<?=$row->title?>" class="img-responsive">
                                        <?php }else{?>
                                            <img src="<?=Yii::$app->params['photo']?>" alt="<?=$row->title?>" class="img-responsive">
                                        <?php }?>
                                    </a>
                                </figure>
                                <span class="add-to-favorite" title="Добавить в избранное" data-favorite="<?=$row->id?>"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                            </div><!-- End .product-top -->
                            <h3 class="product-title"><a href="<?=Common::createdLink($row)?>" title="<?=$row->title?>"><?=$row->title?></a></h3>
                            <div class="product-details-container">
                                <ul>
                                    <li>Площадь:<span><?=$row->details->square?></span> кв.м</li>
                                    <li>Этажность:<span><?=$row->details->floor?></span></li>
                                    <?php if($room = $row->details->room){?>
                                    <li>Комнат:<span><?=$room?></span></li>
                                    <?php }?>
                                </ul>
                            </div>
                            <div class="product-price-container">
                                <span class="product-old-price"><?=number_format(($row->details->original_price), 0, ',', ' ');?> &#8381;</span>
                                <span class="product-price" data-item-price="<?=Common::getSalePrice($row,'');?>"><?=Common::getSalePrice($row,' ');?> &#8381;</span>
                            </div><!-- End .product-price-container -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 -->
                    <?php
                        if ($count%2 == 0 /*&& $count != $pages_size && $count != $items_count*/ && $count != count($model))
                        {
                            echo $teg_div;
                        }
                        $count++;?>
                    <?php endforeach;?>
                    <?=$teg_div?>
                <?php }?>
                <div class="mb30"></div><!-- space -->
                <?php if($pages){?>
                <nav class="pagination-container">
                    <?= \yii\widgets\LinkPager::widget([
                        'pagination' => $pages
                    ]) ?>
                </nav>
                <?php }?>
                <?php if($description){?>
                    <div class="category-details-container">
                        <div><?=$description?></div>
                    </div>
                <?php }else{}?>
            </div><!-- End .col-md-9 -->

<!-- content --><?php $this->endCache(); endif;?>
            <div class="mb30 visible-sm visible-xs"></div><!-- space -->
            <aside class="col-md-3 col-md-pull-9 sidebar">
                <?= $this->render("//inc/leftCat") ?>
            </aside>
        </div><!-- End .row -->

    </div><!-- End .container -->
