<?php

/* @var $this yii\web\View */
use common\components\Common;


$this->title = 'Строительство деревянных домов и бань, брусовые дома, дома из сруба';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Строительство деревянных домов из бруса, дома и бани из оцилиндрованного бревна. Построить брусовый дом под ключ. Проектирование, устройство фундамента, доставка, сборка. Продажа домов из бруса - Сруб-Строй',
]);
$items = Common::getSlider()['items'];
$images = Common::getSlider()['images'];
//$this->registerJsFile('js/jquery.themepunch.revolution.min.js');
?>
<?if($this->beginCache('slider',[
    'variations' => ['slider'],
    'duration' => 7200,
])):?>
    <div id="carousel" class="home-slide carousel slide carousel-fade" data-interval="8000" data-ride="carousel">
        <!-- Carousel items -->
        <div class="carousel-inner">
            <?$cnt = 0;foreach($items as $row):?>
                <?if($cnt == 0){ $active = 'item-vis';}else{$active = 'item-vis';}?>

                <div class="item <?=$active?>">
                    <div class="fill_1 img-scl" data-url="/images/item/<?=$row->alias_item?>/general/<?=\common\components\Common::showGeneralImage($row)[0]?>" style="background-image: url('/images/item/<?=$row->alias_item?>/general/<?=\common\components\Common::showGeneralImage($row)[0]?>')"></div>
                    <div class="elem"></div>
                    <div class="col-md-12 col-md-offset-3">
                        <div class="slider-grid-text">
                            <h4><?=$row->category->title?></h4>
                            <h5><?=$row->title?></h5>
                            <div class="heading-underline"></div>
                            <div class="tp-caption">
                                Скидка от <span class="grandtotal-row product-sale"><strong data-item-sale=""><?=number_format($row->details->original_price - Common::getSalePrice($row,''), 0, ',', ' ')?></strong> &#8381;</span>
                            </div>
                            <a href="<?=Common::createdLink($row)?>" class="btn btn-white btn-border no-radius min-width"><strong>Подробнее</strong></a>
                            <a href="<?=Common::createdLink($row->category)?>" class="btn btn-white no-radius min-width"><strong>Каталог</strong></a>
                        </div>
                    </div>
                </div>

                <?$cnt++;endforeach;?>
        </div>
        <nav class="nav-diamond">
            <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </nav>
    </div>
    <div id="content" role="main" class="no-padding">
    <div class="container-fluid no-padding" id="id-to-scroll">
        <div class="row no-margin">
            <div class="col-lg-6 bg-custom ban_rev1">
                <div class="colored-box">
                    <h3 class="mb20">Строим дома на материнский капитал</h3>
                    <p>
                        Компания ООО «Сруб-Строй» предлагает всем молодым семьям услугу по строительству домов на материнский капитал.
                    </p>
                    <a href="/vopros-otvet/stroite-li-vy-doma-na-materinskij-kapital.htm" class="btn btn-default btn-border no-radius">Подробнее</a>
                </div><!-- End .colored-box -->
            </div><!-- End .col-sm-4 -->
            <div class="col-lg-6 bg-custom2 ban_rev2">
                <div class="colored-box">
                    <h3>Баня в подарок</h3>
                    <p>ООО «Сруб-Строй» рада сообщить прекрасную новость. Теперь при заказе дома на сумму от 1 млн. рублей можно получить баню в подарок.</p>
                    <a href="/skidki/banya-v-podarok.htm" class="btn btn-default btn-border no-radius">Подробней</a>
                </div><!-- End .colored-box -->
            </div><!-- End .col-sm-4 -->
        </div><!-- End .row -->
    </div><!-- End .container-fluid -->
        <div class="bg-lightergray no-overflow pt70 pb30">
            <div class="container">
                <h2 class="title-underblock custom text-uppercase text-center mb50">Наши преимущества</h2>
                <div class="row">
                        <div class="col-sm-3">
                            <div class="service vertical service-hover-bg dark text-center service-box revers" data-box-animation="to-right-animation-0">
                                <div class="service-content">
                                    <h3 class="service-title text-uppercase">Показываем готовые объекты</h3>
                                </div><!-- End .service-content -->
                            </div><!-- End .service -->
                        </div><!-- End .col-sm-3 -->
                        <div class="col-sm-3">
                            <div class="service vertical service-hover-bg dark text-center service-box revers" data-box-animation="to-right-animation-1">
                                <div class="service-content">
                                    <h3 class="service-title text-uppercase">Делаем с отделкой весь цикл работ</h3>
                                </div><!-- End .service-content -->
                            </div><!-- End .service -->
                        </div><!-- End .col-sm-3 -->
                        <div class="col-sm-3">
                            <div class="service vertical service-hover-bg dark text-center service-box revers" data-box-animation="to-right-animation-2">
                                <div class="service-content">
                                    <h3 class="service-title text-uppercase">Выезжаем на участок для осмотра</h3>
                                </div><!-- End .service-content -->
                            </div><!-- End .service -->
                        </div><!-- End .col-sm-3 -->
                        <div class="col-sm-3">
                            <div class="service vertical service-hover-bg dark text-center service-box revers" data-box-animation="to-right-animation-3">
                                <div class="service-content">
                                    <h3 class="service-title text-uppercase">Выгодные условия оплаты(рассрочка)</h3>
                                </div><!-- End .service-content -->
                            </div><!-- End .service -->
                        </div><!-- End .col-sm-3 -->
                </div><!-- End .row -->
            </div>
        </div><!-- End .bg-lightergray -->
    <div class="bg-lightergray no-overflow pt70">
        <div class="container ">
            <h1 class="title-underblock custom text-uppercase text-center mb50">Каталог проектов</h1>
        </div><!-- End .container -->
    </div><!-- End .bg-lightergray -->
    <div class="bg-lightergray pb50">

        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="category-member-box text-center" data-box-animation="to-top-animation-0">
                        <figure>
                            <img src="/images/team/hb1000x700-1.png" alt="Дома из бревна" class="img-responsive">
                        </figure>
                        <h3><a href="/proekti-domov-iz-brevna.htm">Дома из бревна</a></h3>
                    </div><!-- End .team-member -->
                </div><!-- End .member-container -->

                <div class="col-sm-4">
                    <div class="category-member-box text-center" data-box-animation="to-top-animation-0-5">
                        <figure>
                            <img src="/images/team/hbr1000x700-1.png" alt="Дома из бруса" class="img-responsive">
                        </figure>
                        <h3><a href="/proekti-domov-iz-brusa.htm">Дома из бруса</a></h3>
                    </div><!-- End .team-member -->
                </div><!-- End .member-container -->

                <div class="col-sm-4">
                    <div class="category-member-box text-center" data-box-animation="to-top-animation-1">
                        <figure>
                            <img src="/images/team/b1000x700-1.png" alt="Бани из бревна" class="img-responsive">
                        </figure>
                        <h3><a href="/proekti-ban-iz-brevna.htm">Бани из бревна</a></h3>
                    </div><!-- End .team-member -->
                </div><!-- End .member-container -->

            </div><!-- End .row -->


        </div><!-- End .container -->

    </div>
    <div class="bg-dark pt60 pb10 home">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb40">
                    <h2 class="title-underblock custom first-color text-uppercase text-center mb50">Как мы рубим срубы</h2>
                    <div class="blog-content">
                        <p>ООО «Сруб-Строй» – опытная команда специалистов, которая c 2004 года занимается изготовлением домов и бань из высококачественной древесины. Преимуществом компании является полный контроль производственного процесса, начиная от вырубки дерева, его обработки, и заканчивая установкой сооружения на участке заказчика.</p>
                        <p>Компания отличается:</p>
                        <ul class="fa-ul">
                            <li><i class="fa-li fa fa-check-square"></i>тщательным подбором сырья (заготовка только здорового леса при определенных температурах);</li>
                            <li><i class="fa-li fa fa-check-square"></i>гибкой системой оплаты (индивидуальный подход к клиенту);</li>
                            <li><i class="fa-li fa fa-check-square"></i>наличием скидок, акционных предложений на разные виды сооружений.</li>
                        </ul>
                        <p>Перед строительством каждое бревно проходит многоэтапную подготовку, в процессе которой сохраняется естественная устойчивость к различным факторам.</p>
                    </div>
                </div>
                <div class="col-md-6 mb40">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/-xrUxsuuFPU?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div><!-- End .embed-responsive -->
                </div><!-- End .col-md-6 -->
                <div class="col-md-6 mb40">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/-WKBPSBBvfY?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div><!-- End .embed-responsive -->
                </div><!-- End .col-md-6 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .bg-dark -->
    <div class="bg-lightergray no-overflow pt70 pb30">
        <div class="container">
        <h2 class="title-underblock custom text-uppercase text-center mb50">Сервисы компании</h2>

        <div class="row">
            <?$cnt = 0;foreach (Common::getHomeFav()as $row):?>
            <div class="col-sm-4">
                <div class="service vertical service-hover-bg dark text-center service-box" data-box-animation="to-right-animation-<?=$cnt?>">
                    <?$img = Common::showGeneralImage($row)[0];
                    if($img && $row->show_img_cat)
                    {?>
                    <span class="service-icon"><img src="/images/<?=$row->getFolder().'/'.$row->alias_item?>/general/<?=$img?>" alt="<?=$row->title_short?>" class="img-responsive"></span>
                    <?}?>
                    <div class="service-content">
                        <h3 class="service-title text-uppercase"><a href="<?=Common::createdLink($row)?>"><?=$row->title_short?></a></h3>
                        <p><?=Common::substr($row->description,0,230)?></p>
                    </div><!-- End .service-content -->
                </div><!-- End .service -->
            </div><!-- End .col-sm-4 -->
                <?$cnt++?>
                <?if($cnt == 3){echo '</div><div class="row">';}?>
            <?endforeach;?>
        </div><!-- End .row -->
    </div>
    </div><!-- End .bg-lightergray -->
    <div class="bg-dark pt20 pb10 ban_rev3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 count-container-discont smaller text-center">
                    <h3 class="mb20">Успей заказать сруб из зимнего леса</h3>
                    <p>Принимаем заказы на строительство домов и бань из леса зимней заготовки 2017-2018 г.
                        зимний лес из костромской области
                    </p>
                    <a href="/stati/zima-les.htm" class="btn btn-success btn-border">Подробнее</a>
                </div><!-- End .count-container -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .bg-dark -->

    <div class="no-overflow pt70">
        <div class="container ">
            <h2 class="title-underblock custom text-uppercase text-center mb50">Последние новости</h2>
        </div>
    </div>

    <div id="latest-posts" class="container mb50">
        <div class="home-blogposts-carousel owl-carousel nav-border center-nav center-nav-animate no-radius custom-news-carousel" data-owl-carousel="entry-box" data-responsive="3-3-2-1">
            <?foreach(Common::getNews([11,12,15],1) as $row){?>

            <article class="entry entry-box custom-news">
                <div class="entry-media">
                    <figure>
                        <a href="<?=Common::createdLink($row)?>">
                            <?if(($img = Common::showGeneralImage($row)[0]) && $row->show_img_cat)
                            {?>
                                <img src="/images/<?=$row->getFolder().'/'.$row->alias_item?>/general/small_<?=$img?>" alt="Фото-<?=$row->title_short?>">
                            <?}?>
                        </a>
                    </figure>
                </div><!-- End .entry-media -->

                <div class="entry-content-wrapper">
                    <div class="custom-news-date"><span class="news-date"><i class="fa fa-calendar" aria-hidden="true"></i><?=Common::getData($row->date_pub)?></span><span class="news-folder"><i class="fa fa-folder-o" aria-hidden="true"></i><a href="<?=Common::createdLink($row->category)?>"><?=$row->category->title_short?></a></span> </div>
                    <h2 class="entry-title"><a href="<?=Common::createdLink($row)?>"><?=$row->title_short?></a></h2>


                    <div class="entry-content">
                        <p><?=Common::substr($row->description,0,300)?></p>
                    </div><!-- End .entry-content -->
                </div><!-- End .entry-content-wrapper -->

                <footer class="entry-footer clearfix">
                    <a href="<?=Common::createdLink($row)?>" class="entry-readmore text-right">Читать...<i class="fa fa-angle-right"></i></a>
                </footer>
            </article>
            <?}?>
        </div>
    </div>
    <div class="callout custom no-border mb0">
            <div class="mb5"></div><!-- space -->
            <div class="container">
                <div class="callout-wrapper">
                    <div class="callout-left">
                        <h2 class="callout-title">Успей купить сруб по акции - все проекты при минус 10</h2>
                        <p class="callout-desc">Ассортимент, предлагаемый компанией "Сруб-строй", позволяет выбрать вариант дома из сруба или бруса на любой вкус. А сейчас возможность заказать нужную Вам постройку из нашего каталога еще более актуальна, ведь на все постройки из сруба под ключ в Москве и в Московской области мы снизили цены на 10%.</p>
                    </div><!-- End .callout-left -->
                    <div class="callout-right">
                        <a href="/skidki/akciya-vse-proekty-pri-10.htm" class="btn btn-white v2 btn-border min-width wow fadeInUp" data-wow-delay="0.5s">Подробности</a>
                    </div><!-- End .callout-right -->
                </div><!-- End .callout-wrapper -->
            </div><!-- End .container -->
            <div class="mb10"></div><!-- space -->
        </div><!-- End .callout -->

        <div class="container pt70 pb100">
        <header class="title-block text-center mb40">
            <h2 class="title-underblock custom text-uppercase text-center mb50">Клиенты о нас</h2>
        </header>
        <div class="owl-carousel testimonial-carousel2 gray-nav" data-owl-carousel="blockquote-icon" data-responsive="2-2-2-1">
            <?$tesm = Common::getTesm();
            if($tesm){
                foreach ($tesm as $row){?>
                    <blockquote class="blockquote-icon">
                        <p><?=Common::substr($row->description,0,300)?></p>
                        <cite><?=$row->name.'/'.$row->place?></cite>
                    </blockquote>
                <?}
            }?>
            
        </div><!-- End .our-partners -->
    </div><!-- End .container -->

</div><!-- End #content -->
<?$this->endCache(); endif;?>




