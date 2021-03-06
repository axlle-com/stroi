<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use common\components\Common;
/**
 * Created by PhpStorm.
 * User: worker
 * Date: 30.06.2017
 * Time: 14:52
 */
?>
<?php $request_category = Yii::$app->request->get('alias_category');?>
<?php $request_item = Yii::$app->request->get('alias_item');?>
<?php $request_tags = Yii::$app->request->get('alias_tags');?>
<?php $request_page = Yii::$app->request->get('page');?>
<?php if($this->beginCache('leftBlog',[
    'variations' => [$request_category.$request_item.$request_tags.$request_page],
    'duration' => 0,
])):?>
<?php if($request_category == 'kontakt'){}else{?>
    <div class="widget">
        <h3 class="title-border custom">Навигация</h3>
        <ul class="links">
            <?php
            if(!$request_category && $request_item)
            {
                $item = \common\models\Item::findOne(['alias_item' => $request_item]);
                $alias = $item->category->alias_category;
            }
            else
            {
                $alias = $request_category;
            }
            $categories = Common::getLeftNav($alias);
            foreach ($categories['categories'] as $row)
            {
                if($categories['who'])
                {
                    if($row['alias_category'] == $request_category && ($request_item || $request_tags || $request_page)){?>
                        <li class="active"><a href="<?=Url::to(['/'.$row['alias_category']])?>"><i class="fa fa-angle-right"></i><?=$row['title_short']?></a></li>
                    <?php }elseif($row['alias_category'] == $request_category && !$request_item && !$request_tags &&
                        !$request_page){?>
                        <li class="active"><span><i class="fa fa-angle-right"></i><?=$row['title_short']?></span></li>
                    <?php }else{?>
                        <li><a href="<?=Url::to(['/'.$row['alias_category']])?>"><i class="fa fa-angle-right"></i><?=$row['title_short']?></a></li>
                    <?php }
                }else
                {
                    if($row->alias_item == $request_item){?>
                        <li class="active"><span><i class="fa fa-angle-right"></i><?=$row['title_short']?></span></li>
                    <?php }else{?>
                        <?php if(!$row->category->sitemap){?>
                            <li><a href="<?=Url::to(['/'.$row['alias_item']])?>"><i class="fa fa-angle-right"></i><?=$row['title_short']?></a></li>
                        <?php }else{?>
                            <li><a href="<?=Url::to(['/'.$row->category->alias_category.'/'.$row['alias_item']])?>"><i class="fa fa-angle-right"></i><?=$row['title_short']?></a></li>
                        <?php }?>
                    <?php }
                }

            }?>
        </ul>
    </div><!-- End .widget -->
    <?php }?>
<?php $this->endCache(); endif;?>
<?php if($this->beginCache('leftNavNews',[
    'variations' => [$request_category.$request_item],
    'duration' => 7200,
])):?>
<div class="widget tabs">
    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified tab-title" role="tablist">
            <li role="presentation" class="active"><a href="#description1" aria-controls="description1" role="tab" data-toggle="tab">Новое</a></li>
            <li role="presentation"><a href="#description2" aria-controls="description2" role="tab" data-toggle="tab">Популярное</a></li>
        </ul>
        <!-- Tab Panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="description1">
                <ul class="latest-posts-list">
                    <?php foreach(Common::getNews([11,12,15]) as $row)
                    {?>
                    <li class="clearfix">
                        <?php if($row->alias_item == $request_item){?>
                            <h5><a><?=$row->title_short?></a></h5>
                        <?php }else{?>
                            <h5><a href="<?=Common::createdLink($row)?>"><?=$row->title_short?></a></h5>
                        <?php }?>
                        <?php if(($img = Common::showGeneralImage($row)[0]) && $row->show_img_cat)
                        {?>
                            <figure><img src="/images/<?=$row->getFolder().'/'.$row->alias_item?>/general/tumb_<?=$img?>" class="img-responsive" alt="Фото-<?=$row->title_short?>"></figure>
                        <?php }?>
                        <div class="entry-content">
                            <ol>
                                <li><?=Common::getData($row->date_pub,2)?></li>
                                <li><a href="<?=Common::createdLink($row->category)?>"><?=$row->category->title_short?></a></li>
                            </ol>
                        </div><!-- End .entry-content -->
                    </li>
                    <?php }?>
                </ul>
            </div><!-- End .tab-pane -->
            <div role="tabpanel" class="tab-pane" id="description2">
                <ul class="latest-posts-list">
                    <?php foreach(Common::getNews([11,12,15],2) as $row)
                    {?>
                        <li class="clearfix">
                            <?php if($row->alias_item == $request_item){?>
                                <h5><a><?=$row->title_short?></a></h5>
                            <?php }else{?>
                                <h5><a href="<?=Common::createdLink($row)?>"><?=$row->title_short?></a></h5>
                            <?php }?>
                            <?php if(($img = Common::showGeneralImage($row)[0]) && $row->show_img_cat)
                            {?>
                                <figure><img src="/images/<?=$row->getFolder().'/'.$row->alias_item?>/general/tumb_<?=$img?>" class="img-responsive" alt="Фото-<?=$row->title_short?>"></figure>
                            <?php }?>
                            <div class="entry-content">
                                <ol>
                                    <li><?=Common::getData($row->date_pub,2)?></li>
                                    <li><a href="<?=Common::createdLink($row->category)?>"><?=$row->category->title_short?></a></li>
                                </ol>
                            </div><!-- End .entry-content -->
                        </li>
                    <?php }?>
                </ul>
            </div><!-- End .tab-pane -->
        </div><!-- End .tab-content -->
    </div>
</div>

<?php $this->endCache(); endif;?>
<div class="widget">
    <ul class="left-baner">
        <li><a href="/skidki/skidka-na-doma-i-bani-iz-brevna-bolshogo-diametra.htm"><p class="bani_left">Скидка на дома и бани <strong>из бревна большого диаметра</strong></p></a></li>
        <li><a href="/vopros-otvet/stroite-li-vy-doma-na-materinskij-kapital.htm"><p class="mat_cap_left">Работаем с материнским капиталом</p></a></li>
    </ul>

</div><!-- End .widget -->
<div class="widget">

</div><!-- End .widget -->