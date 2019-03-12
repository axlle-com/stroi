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
<!-- content --><?if($this->beginCache('item',[
                'variations' => [$model->alias_item],
                'duration' => 0,
            ])):?>
            <div class="row">
                <div itemscope itemtype="http://schema.org/Product">
                    <div class="col-md-12"><h1 class="title-underblock custom" itemprop="name"><?=$model['title']?></h1></div>
                    <img src="<?=Url::home('https')?>images/<?=$model->getFolder().'/'.$model->alias_item?>/general/<?=Common::showGeneralImage($model)[0]?>" alt="Фото-<?=$model->title?>" style="display: none" itemprop="image"/>
                    <div itemprop="description" style="display: none"><?=$model->description_seo?></div>
                    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <meta itemprop="price" content="<?=Common::getSalePrice($model,'');?>">
                        <meta itemprop="priceCurrency" content="RUB">
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="item-image-box popup-gallery">
                        <div class="product-top">
                            <?if($img = Common::showGeneralImage($model)[0])
                            {?>
                                <div data-big="0" class="box-image image-active">
                                    <img  class="img-responsive" src="/images/<?=$model->getFolder().'/'.$model->alias_item?>/general/<?=$img?>" alt="Фото-<?=$model->title?>"/>
                                </div>
                                <span class="control-left box-gallery-control" data-box-slide="prev"><i class="fa fa-angle-left"></i></span>
                                <span class="control-right box-gallery-control" data-box-slide="next"><i class="fa fa-angle-right"></i></span>
                                <span class="control-loupe box-gallery-control" data-box-slide="loupe"><i class="fa fa-search" aria-hidden="true"></i></span>
                            <?}else{?>
                                <img id="product-zoom" src="<?=Yii::$app->params['photo']?>" data-zoom-image="<?=Yii::$app->params['photo']?>" alt="Фото-<?=$model->title?>"/>
                            <?}?>
                        </div><!-- End .product-top -->

                        <div class="tumb-gallery">
                            <? $img_gal = Common::showGalleryImage($model);?>
                            <?if($img_gal){?>
                                <?sort($img_gal)?>
                                <div class="item-box-gallery">
                                    <span class="item-image-gallery" data-tumb="/images/<?=$model->getFolder().'/'.$model->alias_item?>/general/<?=$img?>" data-title="<?=$model['title']?>" style="background-image: url('/images/<?=$model->getFolder().'/'.$model->alias_item?>/general/tumb_<?=$img?>')"></span>
                                </div>
                                <?foreach($img_gal as $row):?>
                                    <div class="item-box-gallery">
                                        <span class="item-image-gallery" data-tumb="/images/<?=$model->getFolder().'/'.$model->alias_item?>/gallery/<?=$row?>" data-title="<?=$model['title']?>" style="background-image: url('/images/<?=$model->getFolder().'/'.$model->alias_item?>/gallery/tumb_<?=$row?>')"></span>
                                    </div>
                                <?endforeach;?>
                            <?}?>
                        </div>
                    </div><!-- End .product-gallery-container -->
                </div>
                <div class="col-sm-4">
                    <div id = "data-item-container" class="product-details" >
                        <div class="shop-continue-box">
                            <div class="subtotal-row">Общая площадь:<span><?=$model->details->square?> кв.м</span></div>
                            <div class="subtotal-row">Этажность:<span><?=$model->details->floor?></span></div>
                            <?if($room = $model->details->room){?>
                                <div class="subtotal-row">Комнат:<span><?=$room?></span></div>
                            <?}?>
                            <?if($model->details->time_build)
                            {?>
                                <div class="subtotal-row">Строительство:<span><?=$model->details->time_build?> дней</span></div>
                            <?}?>
                            <div class="subtotal-row old-price">Старая цена:<span><strong data-item-old-price="<?=number_format(($model->details->original_price), 0, ',', '');?>"><?=number_format(($model->details->original_price), 0, ',', ' ');?></strong> &#8381;</span></div>
                            <div class="grandtotal-row">Цена:<span><strong data-item-price="<?=Common::getSalePrice($model,'');?>"><?=Common::getSalePrice($model,' ');?></strong> &#8381;</span></div>
                            <div class="grandtotal-row product-sale">Выгода:<span><strong data-item-sale=""><?=number_format($model->details->original_price - Common::getSalePrice($model,''), 0, ',', ' ')?></strong> &#8381;</span></div>

                            <a title="Добавить в избранное" class="multiple-link add-to-favorite" data-favorite="<?=$model->id?>"><i class="fa fa-heart-o" aria-hidden="true"></i>Добавить в избранное</a>
                            <a href="<?=Url::to(['/price/tseny-na-derevyannye-doma-i-bani'])?>" title="Базовая комплектация" class="multiple-link"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Базовая комплектация.<br>Цена указана без отделки.</a>
                            <? if ($same_item = Item::findOne($model->details->same_item))
                            {
                                if( $same_item->details->material == 'lafet' )
                                {
                                    $material = 'лафета';
                                }elseif($same_item->details->material == 'brevno')
                                {
                                    $material = 'бревна';
                                }elseif($same_item->details->material == 'brus')
                                {
                                    $material = 'бруса';
                                }elseif($same_item->details->material == 'profbrus')
                                {
                                    $material = 'проф.бруса';
                                }else{
                                    $material = 'др. материала';
                                }

                                ?>
                                <a href="<?=Common::createdLink($same_item)?>" class="btn btn-default btn-block btn-border text-uppercase">Такой же из <?=$material?></a>
                            <?}?>
                            <button class="btn btn-custom btn-border no-radius button-message message-catalog" data-toggle="modal" data-target="#modal-contact-form-advanced">
                               Получить каталог
                            </button>

                        </div>
                    </div><!-- End .product-details -->
                </div><!-- End .col-md-4 -->
            </div><!-- End .row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="product-description">
                        <?=$model->description?>
                    </div>
                    <button class="btn btn-custom btn-border no-radius button-message message-catalog" data-toggle="modal" data-target="#modal-contact-form-advanced-q">
                        Задать вопрос специалисту
                    </button>
                    <div class="panel-group panel-description" role="tablist" aria-multiselectable="true">
                        <?if($model->infoblocks)
                        {
                            foreach($model->infoblocks as $row):
                                if($row[name] != 'important')
                                {?>
                                    <div class="panel panel-bordered">
                                        <div class="panel-heading" role="tab" id="<?=$row[name].$row[id]?>">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#<?=$row[name]?>" aria-expanded="false" aria-controls="<?=$row[name]?>" class="collapsed">
                                                    <?=$row[title]?>
                                                    <span class="panel-icon"></span>
                                                </a>
                                            </h4>
                                        </div><!-- End .panel-heading -->
                                        <div id="<?=$row[name]?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?=$row[name].$row[id]?>" aria-expanded="false" style="height: 0px;">
                                            <div class="panel-body">
                                                <?=$row[description]?>
                                            </div><!-- End .panel-body -->
                                        </div><!-- End .panel-collapse -->
                                    </div><!-- End .panel -->
                                <?}
                            endforeach;?>
                            <div class="panel panel-bordered">
                                <div class="panel-heading" role="tab" id="important1">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#important" aria-expanded="false" aria-controls="important" class="collapsed">
                                            Важно
                                            <span class="panel-icon"></span>
                                        </a>
                                    </h4>
                                </div><!-- End .panel-heading -->
                                <div id="important" class="panel-collapse collapse" role="tabpanel" aria-labelledby="important1" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body">
                                        <?foreach(Common::getImportant('important') as $low):?>
                                            <div class="row">
                                                <div class="clo-sm-12">
                                                    <div class="col-sm-3">
                                                        <div class="entry-media-service">
                                                            <figure>
                                                                <img src="/images/infoblock/<?=$low[id]?>/general/<?=Common::showGeneralImage($low)[0]?>" alt="<?=$low[title]?>-фото" class="img-responsive">
                                                            </figure>
                                                        </div><!-- End .entry-media -->
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <h3 class="entry-title"><?=$low[title]?></h3>
                                                        <div class="entry-block">
                                                            <?=$low[description]?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?endforeach;?>
                                    </div><!-- End .panel-body -->
                                </div><!-- End .panel-collapse -->
                            </div><!-- End .panel -->
                        <?}?>
                    </div><!-- End .panel-group -->
                </div><!-- End .col-md-12 -->
            </div><!-- End .row -->
<!-- content --><?$this->endCache(); endif;?>

        </div><!-- End .col-md-9 -->

        <div class="mb30 visible-sm visible-xs"></div><!-- space -->

        <aside class="col-md-3 col-md-pull-9 sidebar">

            <? echo $this->render("//inc/leftCat") ?>

        </aside><!-- End .col-md-3 -->

    </div><!-- End .row -->
    <div class="row">
        <div class="col-md-12">

<!-- content --><?if($this->beginCache('related',[
                    'variations' => [$model->category->alias_category.$model->alias_item],
                    'duration' => 10800,
                ])):?>
                <div class="mb50"></div><!-- space -->
                <h3 class="title-underblock custom mb80 text-center">Другие проекты</h3>

                <div class="owl-carousel related-products-carousel2 center-top-nav gray-nav" data-owl-carousel="product" data-responsive="4-3-2-1">

                    <?foreach($related as $row):?>

                        <div class="product text-center">
                            <div class="product-top">
                                <span class="product-box discount-box discount-box-border">-10%</span>
                                <figure>
                                    <a href="<?=Common::createdLink($row)?>" title="<?=$row->title?>">
                                        <?$img_gal = Common::showGalleryImage($row);?>
                                        <?if(($img = Common::showGeneralImage($row)[0]) && ($img_gal))
                                        {
                                            sort($img_gal);?>
                                            <img src="/images/<?=$row->getFolder().'/'.$row->alias_item?>/general/small_<?=$img?>" alt="<?=$row->title?>" class="img-responsive">
                                        <?}else{?>
                                            <img src="<?=Yii::$app->params['photo']?>" alt="<?=$row->title?>" class="img-responsive">
                                        <?}?>

                                    </a>
                                </figure>
                            </div><!-- End .product-top -->
                            <h3 class="product-title"><a href="<?=Common::createdLink($row)?>" title="<?=$row->title?>"><?=$row->title?></a></h3>
                            <div class="product-details-container">
                                <ul>
                                    <li>Площадь:<span><?=$row->details->square?></span> кв.м</li>
                                    <li>Этажность:<span><?=$row->details->floor?></span></li>
                                    <?if($room = $row->details->room){?>
                                        <li>Комнат:<span><?=$room?></span></li>
                                    <?}?>
                                </ul>
                            </div>
                            <div class="product-price-container">
                                <div class="subtotal-row old-price">Старая цена:<span><strong><?=number_format(($row->details->original_price), 0, ',', ' ');?></strong> &#8381;</span></div>
                                <div class="grandtotal-row">Цена:<span><strong><?=Common::getSalePrice($row,' ');?></strong> &#8381;</span></div>
                            </div><!-- End .product-price-container -->

                        </div><!-- End .product -->

                    <?endforeach;?>

                </div><!-- End .owl-carousel -->
<!-- content --><?$this->endCache(); endif;?>

        </div><!-- End .col-md-9 -->
    </div><!-- End .row -->
    <div class="modal fade" id="modal-contact-form-advanced" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="myModalLabel5">Написать нам</h3>
                </div><!-- End .modal-header -->
                <div class="modal-body">
                    <? echo \frontend\widgets\QuestionWidget::widget() ?>
                </div><!-- End .modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Закрыть</button>
                </div><!-- End .modal-footer -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div>
    <div class="modal fade" id="modal-contact-form-advanced-q" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="myModalLabel6">Написать нам</h3>
            </div><!-- End .modal-header -->
            <div class="modal-body">
                <? echo \frontend\widgets\MessageWidget::widget() ?>
            </div><!-- End .modal-body -->
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Закрыть</button>
            </div><!-- End .modal-footer -->
        </div><!-- End .modal-content -->
    </div><!-- End .modal-dialog -->
    </div>
</div><!-- End .container -->
<div class="mb20 hidden-xs hidden-sm"></div><!-- space -->
