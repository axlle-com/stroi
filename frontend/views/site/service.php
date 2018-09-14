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

<!-- content --><?if($this->beginCache('service',[
                'variations' => [$category->alias_category.$request_page],
                'duration' => 0,
                ])):?>
            <div class="col-md-9 col-md-push-3">
                <h1 class="title-underblock custom"><?=$category->title?></h1>
                <?if(!count($model)){}else{?>
                    <?foreach($model as $row):?>
                        <article class="service-item-t">
                                <?$img = Common::showGeneralImage($row)[0];
                                if($img && $row->show_img_cat)
                                {?>
                                <a href="<?=Common::createdLink($row)?>" class="entry-media-service-lt" style="background-image: url('/images/<?=$row->getFolder().'/'.$row->alias_item?>/general/<?=$img?>')">
                                    <div class="entry-media-service-t"></div>
                                </a>
                            <div class="entry-desc-service-t">
                                <h2 class="entry-title"><a href="<?=Common::createdLink($row)?>"><?=$row->title?></a></h2>
                                <h4><i class="fa fa-folder-o" aria-hidden="true"></i><a><?=$row->category->title_short?></a></h4>
                                <p><?=Common::substr($row->description,0,200)?></p>
                            </div>
                            <a class="entry-link-service-t" href="<?=Common::createdLink($row)?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                <?}else{?>
                                    <div class="entry-desc-service-t">
                                        <h2 class="entry-title"><a href="<?=Common::createdLink($row)?>"><?=$row->title?></a></h2>
                                        <h4><i class="fa fa-folder-o" aria-hidden="true"></i><a><?=$row->category->title_short?></a></h4>
                                        <p><?=Common::substr($row->description,0,200)?></p>
                                    </div>
                                    <a class="entry-link-service-t" href="<?=Common::createdLink($row)?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                <?}?>
                        </article>
                    <?endforeach;?>
                <?}?>
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
                <? echo $this->render("//inc/leftBlog") ?>
            </aside>
        </div><!-- End .row -->

    </div><!-- End .container -->
