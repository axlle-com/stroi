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
<!-- content --><?
            if($this->beginCache('category',[
                'variations' => [$category->alias_category.$request_sort.$request_page],
                'duration' => 0,
            ])):?>
            <div class="col-md-9 col-md-push-3">

                <div class="row"><div class="col-md-12"><h1 id="sort" class="title-underblock custom"><?=$title?></h1></div></div>
                <?
                    $alias_category = Yii::$app->request->get(trim('alias_category'));
                    $request_tags = Yii::$app->request->get(trim('alias_tags'));
                    $tags = Common::getTag($alias_category);
                ?>
                <?if(!count($model)){}else{?>
                    <?
                    $count = 1;
                    $teg_row = '<div class="row">';
                    $teg_div = '</div><!-- End .row -->';
                    ?>
                    <?foreach($model as $row):?>
                    <?if($count == 1 || $count%2 != 0)
                        echo $teg_row;
                    ?>
                    <div class="col-sm-6">
                        <div class="product text-center gallery"><!-- Product -->
                            <div class="product-top">
                                <figure>
                                    <a href="<?=Common::createdLink($row)?>" title="<?=$row->title?>">
                                        <?if($img = Common::showGeneralImage($row)[0])
                                        {?>
                                            <img src="/images/<?=$row->getFolder().'/'.$row->alias_item?>/general/small_<?=$img?>" alt="<?=$row->title?>" class="img-responsive">
                                        <?}else{?>
                                            <img src="<?=Yii::$app->params['photo']?>" alt="<?=$row->title?>" class="img-responsive">
                                        <?}?>
                                    </a>
                                </figure>
                            </div><!-- End .product-top -->
                            <h3 class="product-title"><a href="<?=Common::createdLink($row)?>" title="<?=$row->title?>"><?=$row->title?></a></h3>
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 -->
                    <?
                        if ($count%2 == 0 /*&& $count != $pages_size && $count != $items_count*/ && $count != count($model))
                        {
                            echo $teg_div;
                        }
                        $count++;?>
                    <?endforeach;?>
                    <?=$teg_div?>
                <?}?>
                <div class="mb30"></div><!-- space -->
                <?if($pages){?>
                <nav class="pagination-container">
                    <? echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pages
                    ]) ?>
                </nav>
                <?}?>
                <?if($description){?>
                    <div class="category-details-container">
                        <p><?=$description?></p>
                    </div>
                <?}else{}?>
            </div><!-- End .col-md-9 -->

<!-- content --><?$this->endCache(); endif;?>
            <div class="mb30 visible-sm visible-xs"></div><!-- space -->
            <aside class="col-md-3 col-md-pull-9 sidebar">
                <? echo $this->render("//inc/leftBan") ?>
            </aside>
        </div><!-- End .row -->

    </div><!-- End .container -->
