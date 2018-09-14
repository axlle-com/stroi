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

<div class="widget">
    <?$request_category = Yii::$app->request->get('alias_category');?>
    <?$request_item = Yii::$app->request->get('alias_item');?>
    <?$request_tags = Yii::$app->request->get('alias_tags');?>
    <?$request_page = Yii::$app->request->get('page');?>
    <?if($this->beginCache('leftNav',[
                    'variations' => [$request_category.$request_item.$request_tags.$request_page],
                    'duration' => 0,
                ])):?>
    <h3 class="title-border custom">Навигация</h3>
        <ul class="links">
            <? $categories = Common::getLeftNav($request_category);
            foreach ($categories['categories'] as $row)
            {
                if($categories['who'])
                {
                    if($row['alias_category'] == $request_category && ($request_item || $request_tags || $request_page)){?>
                        <li class="active"><a href="<?=Url::to(['/'.$row['alias_category']])?>"><i class="fa fa-angle-right"></i><?=$row['title_short']?></a></li>
                    <?}elseif($row['alias_category'] == $request_category && !$request_item && !$request_tags && !$request_page){?>
                        <li class="active"><span><i class="fa fa-angle-right"></i><?=$row['title_short']?></span></li>
                    <?}else{?>
                        <li><a href="<?=Url::to(['/'.$row['alias_category']])?>"><i class="fa fa-angle-right"></i><?=$row['title_short']?></a></li>
                    <?}
                }else
                {
                    if($row['alias_item'] == $request_item){?>
                        <li class="active"><span><i class="fa fa-angle-right"></i><?=$row['title_short']?></span></li>
                    <?}else{?>
                        <li><a href="<?=Url::to(['/'.$row->category->alias_category.'/'.$row['alias_item']])?>"><i class="fa fa-angle-right"></i><?=$row['title_short']?></a></li>
                    <?}
                }

            }?>
        </ul>
    <?$this->endCache(); endif;?>
</div><!-- End .widget -->
<div class="widget">
    <ul class="left-baner">
        <li><a href="/skidki/banya-v-podarok.htm"><p class="bani_left">Лимитированная акция <strong>Баня в подарок</strong></p></a></li>
        <li><a href="/vopros-otvet/stroite-li-vy-doma-na-materinskij-kapital.htm"><p class="mat_cap_left">Работаем с материнским капиталом</p></a></li>
    </ul>
</div><!-- End .widget -->
