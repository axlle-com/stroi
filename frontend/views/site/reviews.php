<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\components\Common;
use yii\helpers\Url;

$request_page = Yii::$app->request->get(trim('page'));
$request_page = (int)$request_page;
if($request_page && $request_page != 1){
    $title = $category->title.' Страница - '.$request_page;
    $title_seo = $category->title_seo.' Страница - '.$request_page;
    $description_seo = $category->description_seo.' Страница - '.$request_page;
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

<!-- content --><?php if($this->beginCache('reviews',[
                'variations' => [$category->alias_category.$request_page],
                'duration' => 0,
                ])):?>
            <div class="col-md-9 col-md-push-3 reviews">
                <h1 class="title-underblock custom"><?=$title?></h1>
                <?php if($description){?>
                    <div class="category-details-container">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="reviews-pozitive"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i><?=Common::getPoz()?></p>
                                <p class="reviews-negative"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i><?=Common::getNeg()?></p>
                                <button class="btn btn-custom btn-border no-radius button-reviews" data-toggle="modal" data-target="#modal-contact-form-advanced">
                                    Отправить отзыв
                                </button>
                            </div>
                            <div class="col-md-9">
                                <p><?=$description?></p>
                            </div>
                        </div>


                    </div>
                <?php }else{}?>
                <?php if(!count($model)){}else{?>
                    <?php foreach($model as $row):?>
                        <?php if(!$row->positively){$color = 'rev-bad';}else{$color = '';}?>
                        <article class="entry <?=$color?>">

                            <span class="entry-date <?=$color?>"><?=Common::getData($row->data,0)[0]?><span><?=Common::getData($row->data,0)[1]?></span></span>
                            <span class="entry-format <?=$color?>">
                                <?php if($row->positively){?>
                                    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                <?php }else{?>
                                    <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                                <?php }?>
                            </span>

                            <h2 class="entry-title"><?=$row->title?></h2>
                            <ul>
                                <?php if($row->name){?>
                                    <li><i class="fa fa-address-card-o" aria-hidden="true"></i><?=$row->name?></li>
                                <?php }?>
                                <?php if($row->place){?>
                                    <li><i class="fa fa-map-marker" aria-hidden="true"></i><?=$row->place?></li>
                                <?php }?>
                            </ul>
                            <div class="entry-content <?=$color?>">
                                <p><?=$row->description?></p>
                                <?php if($im = Common::showGalleryImage($row)){?>
                                <div class="popup-gallery">
                                    <div class="row">
                                    <?php $cnt =  0;sort($im); foreach($im as $low):?>
                                        <div class="col-sm-3">
                                            <div class="portfolio-item portfolio-image-zoom">
                                                <figure>
                                                    <a href="/images/reviews/<?=$row->id?>/gallery/<?=$low?>" class="zoom-item" title="<?=$row->title.' Фото-'.($cnt+1)?>" data-tumb="/images/reviews/<?=$row->id?>/gallery/<?=$low?>" data-title="<?=$row->title.' Фото-'.($cnt+1)?>">
                                                        <img class="img-responsive" src="/images/reviews/<?=$row->id?>/gallery/small_<?=$low?>" alt="<?=$row->title.' Фото-'.($cnt+1)?>" title="<?=$row->title.' Фото-'.($cnt+1)?>"/>
                                                    </a>
                                                </figure>
                                            </div><!-- End .portfolio-item -->
                                        </div><?php $cnt++; if($cnt%4 == 0 && $cnt != 4){echo '</div><div class="row">';}?>

                                    <?php endforeach;?>
                                    </div>
                                </div>
                                <?php }?>
                            </div><!-- End .entry-content -->
                            <?php if($row->description_rev){?>
                            <div class="reviews-ans">
                                <span class="entry-answer <?=$color?>"><i class="fa fa-comments-o" aria-hidden="true"></i></span>
                                <ul>
                                    <li><i class="fa fa-commenting-o" aria-hidden="true"></i><?=$row->title_rev?></li>
                                    <li><i class="fa fa-address-card-o" aria-hidden="true"></i><?=$row->name_rev?></li>
                                </ul>
                                <div class="reviews-content">
                                    <p><?=$row->description_rev?></p>
                                </div><!-- End .reviews-content -->
                            </div>
                            <?php }?>
                            <span class="close-rev <?=$color?>"></span>
                        </article>
                    <?php endforeach;?>
                <?php }?>

                <div class="mb30"></div><!-- space -->
                <?php if($pages){?>
                <nav class="pagination-container">
                    <?= \yii\widgets\LinkPager::widget([
                        'pagination' => $pages
                    ]) ?>
                </nav>
                <?php }?>
            </div><!-- End .col-md-9 -->
<!-- content --><?php $this->endCache(); endif;?>

            <div class="mb30 visible-sm visible-xs"></div><!-- space -->
            <aside class="col-md-3 col-md-pull-9 sidebar">
                <?= $this->render("//inc/leftBlog") ?>
            </aside>
        </div><!-- End .row -->

    </div><!-- End .container -->

<div class="modal fade" id="modal-contact-form-advanced" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="myModalLabel5">Отправить отзыв</h3>
            </div><!-- End .modal-header -->
            <div class="modal-body">
                <?= \frontend\widgets\MessageWidget::widget() ?>
            </div><!-- End .modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Закрыть</button>
            </div><!-- End .modal-footer -->
        </div><!-- End .modal-content -->
    </div><!-- End .modal-dialog -->
</div>