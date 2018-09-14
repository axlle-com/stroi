<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use common\models\Tags;
use common\models\Category;
use common\models\Item;
use common\models\Reviews;
use common\components\Common;
use yii\helpers\Url;


$items = Common::getSlider()['items'];
$images = Common::getSlider()['images'];
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <div class="site-about row">
        <div class="col-md-12">
            <h1><?= Html::encode($this->title) ?><?=Yii::$app->request->userIP?></h1>
            «Сруб-Строй» <strong>+7 (915) 91 000 55</strong>    <strong class="customkey" class="custom-link"></strong>
        </div>
    </div>
<div class="blog-content">
    <p></p>
    <h2></h2>
    <ul class="list-style list-square">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <ul class="list-style list-decimal">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div>
    <div class="popup-gallery">
        <h2></h2>
        <div class="row">
            <div class="col-sm-6">
                <div class="portfolio-item portfolio-image-zoom">
                    <figure>
                        <a href="/images/image/zoomzoom/general/general_zoomzoom_1503565776.jpg" class="zoom-item tumb-active" title="Сортировка леса фото-1" data-tumb="/images/image/zoomzoom/general/general_zoomzoom_1503565776.jpg">
                            <img class="img-responsive" src="/images/image/zoomzoom/general/small_general_zoomzoom_1503565776.jpg" alt="Сортировка леса фото-1" title="Сортировка леса фото-1">
                        </a>
                    </figure>
                    <div class="portfolio-meta">
                        <h3 class="portfolio-title">Сортировка леса фото-1</h3>
                    </div><!-- End .portfolio-meta -->
                </div><!-- End .portfolio-item -->
            </div>
            <div class="col-sm-6">
                <div class="portfolio-item portfolio-image-zoom">
                    <figure>
                        <a href="/images/image/zoomzoom/general/general_zoomzoom_1503565795.jpg" class="zoom-item" title="Сортировка леса фото-2" data-tumb="/images/image/zoomzoom/general/general_zoomzoom_1503565795.jpg">
                            <img class="img-responsive" src="/images/image/zoomzoom/general/small_general_zoomzoom_1503565795.jpg" alt="Сортировка леса фото-2" title="Сортировка леса фото-2">
                        </a>
                    </figure>
                    <div class="portfolio-meta">
                        <h3 class="portfolio-title">Сортировка леса фото-2</h3>
                    </div><!-- End .portfolio-meta -->
                </div><!-- End .portfolio-item -->
            </div>
        </div>
    </div>

<div class="blog-content">
    <p>Бани из бревна с террасой – оптимальное решение, позволяющее превратить парную из обычного помещения для банных процедур в комфортное и стильное место релакса и отдыха с родными или друзьями. Подобное строение можно использовать не только в качестве банных процедур, но и устроить настоящее застолье на лоне природы или расслабиться после парилки. Места хватит всем.</p>
    <h2>Проекты бань с террасой: в чем польза?</h2>
    <p>Терраса - горизонтальная площадка или открытая веранда при входе в здание, которая оснащена настилом из дерева. Она может быть оборудована перилами и крышей, но возможны варианты с отсутствием навеса или глухими стенами. Удобная пристройка для отдыха:</p>
    <ul class="list-style list-square">
        <li>придает зданию привлекательный вид;</li>
        <li>действует в качестве теплоизоляционной преграды, предотвращающей проникновение в парную холодных потоков воздуха;</li>
        <li>служит частичной защитой для комнат от попадания грязи с улицы</li>
    </ul>
    <h2>Заказать строительство бани с террасой в «Сруб-Строй»</h2>
    <p>Компания «Сруб-Строй» имеет многолетний опыт возведения строений из бревен и создаст для вас уютную баньку по индивидуальному заказу. Мы работаем в Москве и Московской области, принимая заказы ежедневно с 9 утра до 20-00 без выходных. Позвонить нам можно по телефону +7 (495) 997 10 78 .</p>
</div>

    <?php
    $item = Common::getHotPrice();
    $cnt = 0;
    $cnt1 = 0;
    ?>
    <div class="col-md-2">
    <?foreach ($item['item'] as $i){
        $cnt++;
        echo $cnt.'.'.$i->position.'<br>';
    }?>
    </div><div class="col-md-2">
    <?foreach ($item['details'] as $j){
        $cnt1++;
        echo $cnt1.'.'.$j->original_price.'<br>';
    }
    ?></div>


<?php
    // Выбираем категории сайта
    $categories = Category::find()->where(['sitemap' => 1])->all();
    foreach ($categories as $category) {
        if($category->render->name == 'reviews'){
            $items_count = Reviews::find()->where(['category_id' => $category->id])->count();
            $pages = ceil($items_count/12);
            if(1){
                $urls[] = array(
                    Yii::$app->urlManager->createUrl([$category->alias_category]) // создаем ссылки на выбранные категории
                , 'daily'                                                           // вероятная частота изменения категории
                );
            }else{
                for($i = 1; $i <= $pages; $i++ ){
                    if($i == 1){
                        $urls[] = array(
                            Yii::$app->urlManager->createUrl([$category->alias_category]) // создаем ссылки на выбранные категории
                        , 'daily'                                                           // вероятная частота изменения категории
                        );
                    }else{
                        $urls[] = array(
                            Yii::$app->urlManager->createUrl([$category->alias_category.'/Page-'.$i]) // создаем ссылки на выбранные категории
                        , 'daily'                                                           // вероятная частота изменения категории
                        );
                    }
                }
            }
        }else{
            $items_count = Item::find()->where(['category_id' => $category->id])->andWhere(['sitemap' => 1])->count();
            //$items_count = count($category->items);
            //$pages = $items_count/12;
            $pages = ceil($items_count/12);
            if(1){
                $urls[] = array(
                    Yii::$app->urlManager->createUrl([$category->alias_category]) // создаем ссылки на выбранные категории
                , 'daily'                                                           // вероятная частота изменения категории
                );
            }else{
                for($i = 1; $i <= $pages; $i++ ){
                    if($i == 1){
                        $urls[] = array(
                            Yii::$app->urlManager->createUrl([$category->alias_category]) // создаем ссылки на выбранные категории
                        , 'daily'                                                           // вероятная частота изменения категории
                        );
                    }else{
                        $urls[] = array(
                            Yii::$app->urlManager->createUrl([$category->alias_category.'/Page-'.$i]) // создаем ссылки на выбранные категории
                        , 'daily'                                                           // вероятная частота изменения категории
                        );
                    }
                }
            }
        }

    }
    // Выбираем теги сайта
    $tags = Tags::find()->where(['sitemap' => 1])->all();
    foreach ($tags as $tag) {
        $tags_count = count($tag->items);
        $pages = ceil($tags_count/12);
        if(1){
            $urls[] = array(
                Yii::$app->urlManager->createUrl([$tag->alias_category. '/' .$tag->alias_tags]) // создаем ссылки на выбранные категории
            , 'daily'                                                           // вероятная частота изменения категории
            );
        }else{
            for($i = 1; $i <= $pages; $i++ ){
                if($i == 1){
                    $urls[] = array(
                        Yii::$app->urlManager->createUrl([$tag->alias_category. '/' .$tag->alias_tags]) // создаем ссылки на выбранные категории
                    , 'daily'                                                           // вероятная частота изменения категории
                    );
                }else{
                    $urls[] = array(
                        Yii::$app->urlManager->createUrl([$tag->alias_category. '/' .$tag->alias_tags.'/Page-'.$i]) // создаем ссылки на выбранные категории
                    , 'daily'                                                           // вероятная частота изменения категории
                    );
                }
            }
        }
    }
    // Записи Блога
    $posts = Item::find()->where(['sitemap' => 1])->all();
    foreach ($posts as $post) {
        $urls[] = array(
            Yii::$app->urlManager->createUrl([$post->category->alias_category . '/' . $post->alias_item]) // строим ссылки на записи блога
        , 'weekly'
        );
    }
?>
    <ul class="list-style list-decimal">
        <? foreach($urls as $url): ?>
            <li><a href="<?= Yii::$app->request->hostInfo . $url[0] ?>" target="_blank"><?= Yii::$app->request->hostInfo . $url[0] ?></a></li>
        <? endforeach; ?>
    </ul>

</div>