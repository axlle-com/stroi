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

<div class="blog-content">
    <p>Строения из бревна 30-40 см одни из самых долговечных и эстетичных сооружений 21 века. Они несут в себе красоту и энергетику вековых деревьев. Срубы домов из такого диаметра при правильной эксплуатации смогут прослужить сотню лет. Очень красиво смотрятся интерьеры таких строений, особенно бань.</p>
    <p>Компания «Сруб-Строй» второй десяток лет, а именно 14 лет, занимается изготовлением срубов домов и бань из бревна диаметром 30-40 см, наши работы можно увидеть в фотогалерее и в живую у конкретных заказчиков которым мы построили в этом и предыдущих годах.</p>
    <div class="custom-info-block"><div class="info-label"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></div>
        <div class="custom-info">
            Скидка на дома и бани диаметром 30-40 см - 12%
        </div>
    </div>
    <p>Наша компания рада сообщить любителям сооружений из бревна диаметром 30-40 см, что теперь предоставляется скидка 12%.</p>
</div>

    <ul class="list-style list-decimal">
        <li>Стеновой комплект из бруса</li>
        <li>Межвенцовый утеплитель</li>
        <li>Метизы , нагели</li>
        <li>Половые, потолочные балки</li>
        <li>Гидроизоляция фундамента</li>
        <li>Стропильная система</li>
        <li>Обрешётка крыши</li>
        <li>Кровля рубероид</li>
        <li>Фронтоны имитация бруса</li>
        <li>Доставка</li>
        <li>Разгрузка</li>
        <li>Сборка дома с кровлей</li>
    </ul>
    <a href="/price/tseny-na-derevyannye-doma-i-bani.htm" class="entry-readmore text-right">Подробнее...<i class="fa fa-angle-right"></i></a>
    
    
    
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