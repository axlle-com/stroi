<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use common\models\Item;
use yii\widgets\Breadcrumbs;
use common\components\Common;
use yii\helpers\Url;
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::to('@web/'.$model->category->alias_category.'/'.$model->alias_item.'.htm', true)]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->description_seo,
]);
$this->title = $model->title_seo;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-push-3">
<!-- content --><?php if($this->beginCache('post',[
                    'variations' => [$model->alias_item],
                    'duration' => 0,
                ])):?>

                <article class="price-one">
                    <h1 class="title-underblock custom"><?=$model['title']?></h1>
                    <?php if($model->show_img)
                    {?>
                        <div class="entry-media">
                            <?php if(($img = Common::showGeneralImage($model)[0]) && !($img_gal =
                            Common::showGalleryImage($model)) && $model->show_img_post)
                            {?>
                                <figure>
                                    <img src="/images/<?=$model->getFolder().'/'.$model->alias_item?>/general/<?=$img?>" alt="Фото-<?=$model->title?>"/>
                                </figure>
                            <?php }?>
                            <?php if($img_gal = Common::showGalleryImage($model))
                            {?>
                                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="7000">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        <?php $count1 = 0;?>
                                        <?php foreach($img_gal as $row):?>
                                            <?php if($count1 == 0){$marker1 = 'active';}else{$marker1 = '';}?>
                                                <li data-target="#carousel-example-generic" data-slide-to="<?=$count1?>" class="<?=$marker1?>"></li>
                                            <?php $count1++?>
                                        <?php endforeach;?>
                                    </ol>
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                        <?php $count2 = 1;?>
                                        <?php foreach($img_gal as $row):?>
                                            <?php if($count2 == 1){$marker2 = 'active';}else{$marker2 = '';}?>
                                                <div class="item <?=$marker2?>">
                                                    <img src="/images/<?=$model->getFolder().'/'.$model->alias_item?>/gallery/<?=$row?>" alt="Фото-<?=$model->title.' '.$count2?>"/>
                                                </div><!-- End .item -->
                                            <?php $count2++?>
                                        <?php endforeach;?>
                                    </div><!-- End .carousel-inner -->
                                    <!-- Controls -->
                                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                </div>

                            <?php }?>
                        </div><!-- End .entry-media -->
                    <?php }?>
                    <?php if($model->show_data)
                    {?>
                        <div class="blog-entry-meta">
                            <div class="blog-entry-meta-date">
                                <i class="fa fa-calendar" aria-hidden="true"></i><?=Common::getData($model->date_pub)?>
                            </div>
                            <div class="blog-entry-meta-folder">
                                <i class="fa fa-folder-o" aria-hidden="true"></i><a href="<?=Common::createdLink($model,0)?>"><?=$model->category->title_short?></a>
                            </div>
                        </div>
                    <?php }?>
                    <div class="entry-content">
                        <?=$model->description?>
                    </div><!-- End .entry-content -->
                    <?php if($model->media){?>
                        <div class="col-md-12 mb40">
                            <div class="embed-responsive embed-responsive-16by9">
                                <?=$model->media?>
                            </div><!-- End .embed-responsive -->
                        </div><!-- End .col-md-6 -->
                    <?php }?>
                    <?php if($model->show_message)
                    {?>
                        <div class="blog-message">
                            <button class="btn btn-custom btn-border no-radius button-message" data-toggle="modal" data-target="#modal-contact-form-advanced">
                                Задать вопрос
                            </button>
                        </div>
                    <?php }?>
                    <?php if($im = $model->folders[0]->images){?>
                        <div class="popup-gallery">
                            <h2><?=$model->folders[0]->title?></h2>
                            <div class="row">
                                <?php $cnt =  0; foreach($im as $row):?>
                                    <div class="col-sm-4">
                                        <div class="portfolio-item portfolio-image-zoom">
                                            <figure>
                                                <a href="/images/image/<?=$row->folder->link?>/general/<?=$row->general_photo?>" class="zoom-item" title="<?=$row->title?>" data-tumb="/images/image/<?=$row->folder->link?>/general/<?=$row->general_photo?>">
                                                    <img class="img-responsive" src="/images/image/<?=$row->folder->link?>/general/small_<?=$row->general_photo?>" alt="<?=$row->alt?>" title="<?=$row->title?>"/>
                                                </a>
                                            </figure>
                                            <?php if($row->title){?>
                                            <div class="portfolio-meta">
                                                <h3 class="portfolio-title"><?=$row->title?></h3>
                                            </div><!-- End .portfolio-meta -->
                                            <?php }?>
                                        </div><!-- End .portfolio-item -->
                                    </div><?php $cnt++; if($cnt%3 == 0 && $cnt != 3){echo '</div><div class="row">';}?>
                                <?php endforeach;?>
                            </div>
                        </div>
                    <?php }?>
                </article>
<!-- content --><?php $this->endCache(); endif;?>
            <?php if($model->alias_item == 'on-line-kalkulyator')
            {?>
                <?= \frontend\widgets\CalculationWidget::widget() ?>
            <?php }?>
            <?php if($model->show_message)
            {?>
                <div class="modal fade" id="modal-contact-form-advanced" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    <h3 class="modal-title" id="myModalLabel5">Написать нам</h3>
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
            <?php }?>

            <div class="mb30 visible-sm visible-xs"></div><!-- space -->
        </div>
        <aside class="col-md-3 col-md-pull-9 sidebar">
            <?= $this->render("//inc/leftBlog") ?>
        </aside><!-- End .col-md-3 -->
    </div><!-- End .row -->
</div><!-- End .container -->

<div class="mb20 hidden-xs hidden-sm"></div><!-- space -->
