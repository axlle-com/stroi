<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\components\Common;


$request_alias = Yii::$app->request->get('alias_category');
$request_item = Yii::$app->request->get('alias_item');
$request_tags = Yii::$app->request->get('alias_tags');
$request_page = Yii::$app->request->get('page');
?>
<!-- Header Starts -->

<header id="header" role="banner">
    <div class="collapse navbar-white" id="header-search-form">
        <div class="ya-site-form ya-site-form_inited_no" onclick="return {'action':'http://www.srub-stroi.ru/search.htm','arrow':false,'bg':'transparent','fontsize':12,'fg':'#000000','language':'ru','logo':'rb','publicname':'Поиск по www.srub-stroi.ru','suggest':true,'target':'_self','tld':'ru','type':3,'usebigdictionary':true,'searchid':2303785,'input_fg':'#000000','input_bg':'#ffffff','input_fontStyle':'normal','input_fontWeight':'normal','input_placeholder':null,'input_placeholderColor':'#000000','input_borderColor':'#7f9db9'}">
            <form class="navbar-form animated fadeInDown" action="https://yandex.ru/search/site/" method="get" target="_self" accept-charset="utf-8">
                <input type="hidden" name="searchid" value="2303785"/>
                <input type="hidden" name="l10n" value="ru"/>
                <input type="hidden" name="reqenc" value=""/>
                <input type="search" id="text" name="text" class="form-control" placeholder="Поиск..." value="">
                <button type="submit" class="btn-circle" title="Поиск"><i class="fa fa-search"></i></button>
            </form>
        </div><!-- End .container -->
    </div><!-- End #header-search-form -->
    <nav class="navbar navbar-white animated-dropdown ttb-dropdown" role="navigation">
        <div class="navbar-top clearfix">
            <div class="container">
                <div class="pull-left clearfix">
                    <ul class="phone">
                        <li><i class="fa fa-phone-square" aria-hidden="true"></i><a href="tel:+79159100055"> +7 (915) 91 000 55</a></li>
                        <li><i class="fa fa-fax" aria-hidden="true"></i><span data-company-tel="2"><a href="tel:+74959971078"> +7 (495) 997 10 78</a></span></li>
                    </ul>
                </div><!-- End .pull-left -->

                <div class="pull-right">
                    <ul class="social pull-right hidden-xs">
                        <li class="whatsapp"><span class="hidden-link" data-link="https://api.whatsapp.com/send?phone=79159100055"><i class="fa fa-whatsapp" aria-hidden="true"></i></span></li>
                        <li class="vk"><span class="hidden-link" data-link="https://vk.com/club142581712"><i class="fa fa-vk" aria-hidden="true"></i></span></li>
                        <li class="instagram"><span class="hidden-link" data-link="https://www.instagram.com/srub_stroi/"><i class="fa fa-instagram" aria-hidden="true"></i></span></li>
                        <li class="odnoklassniki"><span class="hidden-link" data-link="https://ok.ru/srubstroy"><i class="fa fa-odnoklassniki" aria-hidden="true"></i></span></li>
                        <li class="facebook"><span class="hidden-link" data-link="https://www.facebook.com/%D0%9E%D0%9E%D0%9E-%D0%A1%D1%80%D1%83%D0%B1-%D0%A1%D1%82%D1%80%D0%BE%D0%B9-2023617047869850"><i class="fa fa-facebook"></i></span></li>
                        <li class="youtube"><span class="hidden-link" data-link="https://www.youtube.com/channel/UCFxN1jZRwXW5qmWOjxEiMtw"><i class="fa fa-youtube" aria-hidden="true"></i></span></li>
                    </ul>
                    <div class="mail pull-right clearfix">
                        <i class="fa fa-envelope" aria-hidden="true"></i><span data-company-mail="1"><a id="info_mail" href="mailto:info@srub-stroi.ru"> info@srub-stroi.ru</a></span>
                    </div><!-- End. phone -->

                </div><!-- End .pull-right -->
            </div><!-- End .container -->
        </div><!-- End .navbar-top -->

        <div class="navbar-inner sticky-menu">
            <div class="container">
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle pull-right collapsed" data-toggle="collapse" data-target="#main-navbar-container">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand text-uppercase" href="/" title="ООО 'Сруб-Строй' Строительство деревянных домов и бань"><img src="/images/backgrounds/log_2.png" class="img-responsive img-logo"></a>


                    <button type="button" class="navbar-btn btn-icon pull-right last visible-sm visible-xs" data-toggle="collapse" data-target="#header-search-form"><i class="fa fa-search"></i></button>
                    <button type="button" class="navbar-btn btn-icon pull-right last visible-sm visible-xs" data-favorite-box="1" data-link-sort="/favorite.htm"><span></span><i class="fa fa-heart-o"></i></button>
                </div><!-- End .navbar-header -->

                <div class="collapse navbar-collapse" id="main-navbar-container">
                    <?if($this->beginCache('topNav',[
                        'variations' => [$request_alias.$request_item.$request_tags.$request_page],
                        'duration' => 0,
                    ])):?>
                        <ul class="nav navbar-nav">
                        <li class="dropdown">

                            <?foreach (Common::getTopNav(2) as $row)
                            {
                                if($request_alias == $row['alias_category'])
                                {
                                    $active_2 = 'active';
                                    break;
                                }else{
                                    $active_2 ='';
                                }
                            }?>
                            <a class="dropdown-toggle <?=$active_2?>" data-toggle="dropdown" role="button" aria-expanded="false">Проекты<span class="angle"></span></a>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <?foreach (Common::getTopNav(2) as $row)
                                {
                                    if($row['alias_category'] == $request_alias && ($request_item || $request_tags || $request_page)){?>
                                        <li class="active"><a href="<?=Url::to(['/'.$row['alias_category']])?>"><?=$row['title_short']?></a></li>
                                    <?}elseif($row['alias_category'] == $request_alias && !$request_item && !$request_tags && !$request_page){?>
                                        <li class="active"><a><?=$row['title_short']?></a></li>
                                    <?}else{?>
                                        <li><a href="<?=Url::to(['/'.$row['alias_category']])?>"><?=$row['title_short']?></a></li>
                                    <?}
                                }?>
                                
                            </ul>
                        </li>
                        <li class="dropdown">
                            <?if($request_alias == 'price')
                            {
                                $active_4 = 'active';
                            }else{
                                $active_4 = '';
                            }?>
                            <a class="dropdown-toggle <?=$active_4?>" data-toggle="dropdown" role="button" aria-expanded="false">Цены<span class="angle"></span></a>

                            <ul class="dropdown-menu pull-right" role="menu">
                                <?foreach (Common::getTopNav(9,0) as $row)
                                {
                                    if($row['alias_item'] == $request_item){?>
                                        <li class="active"><a><?=$row['title_short']?></a></li>
                                    <?}else{?>
                                        <li><a href="<?=Url::to(['/'.$row->category->alias_category.'/'.$row['alias_item']])?>"><?=$row['title_short']?></a></li>
                                    <?}
                                }?>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <?foreach (Common::getTopNav(10) as $row)
                            {
                                if($request_alias == $row['alias_category'])
                                {
                                    $active_5 = 'active';
                                    break;
                                }else{
                                    $active_5 ='';
                                }
                            }?>

                            <a class="dropdown-toggle <?=$active_5?>" data-toggle="dropdown" role="button" aria-expanded="false">Информация<span class="angle"></span></a>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <?foreach (Common::getTopNav(10) as $row)
                                {
                                    if($row['alias_category'] == $request_alias && ($request_item || $request_tags || $request_page)){?>
                                        <li class="active"><a href="<?=Url::to(['/'.$row['alias_category']])?>"><?=$row['title_short']?></a></li>
                                    <?}elseif($row['alias_category'] == $request_alias && !$request_item && !$request_tags && !$request_page){?>
                                        <li class="active"><a><?=$row['title_short']?></a></li>
                                    <?}else{?>
                                        <li><a href="<?=Url::to(['/'.$row['alias_category']])?>"><?=$row['title_short']?></a></li>
                                    <?}
                                }?>
                            </ul>
                        </li>
                            <?if($request_alias == 'gallery' ){?>
                                <li><a class="active">Галерея</a></li>
                            <?}else{?>
                                <li><a href="<?= Url::to(['/gallery']);?>">Галерея</a></li>
                            <?}?>
                            <?if($request_alias == 'otzyvy' ){?>
                                <li><a class="active">Отзывы</a></li>
                            <?}else{?>
                                <li><a href="<?= Url::to(['/otzyvy']);?>">Отзывы</a></li>
                            <?}?>
                         <?if($request_alias == 'kontakt' ){?>
                            <li><a class="active">Контакты</a></li>
                        <?}else{?>
                            <li><a href="<?= Url::to(['/kontakt']);?>">Контакты</a></li>
                        <?}?>
                    </ul>
                    <?$this->endCache(); endif;?>
                    <button type="button" class="navbar-btn btn-icon navbar-right last  hidden-sm hidden-xs" data-toggle="collapse" data-target="#header-search-form"><i class="fa fa-search"></i></button>
                    <button type="button" class="navbar-btn btn-icon navbar-right last  hidden-sm hidden-xs" data-favorite-box="2" data-link-sort="/favorite.htm"><span></span><i class="fa fa-heart-o"></i></button>
                </div><!-- /.navbar-collapse -->

            </div><!-- /.container -->
        </div><!-- End .navbar-inner -->
    </nav>
</header><!-- End #header -->
<!-- End header -->
