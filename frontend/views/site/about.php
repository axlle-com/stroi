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
        <p>Усталость от шумного города, однообразных "бетонных джунглей" и загазованного воздуха провоцирует желание обзавестись собственным домом за городом. На роль основного материала все чаще выбирают дерево. Особо популярны рубленные дома из бревна, проживание в которых привлекает возможностью приблизиться к природе. Дома изготавливаются из бревна, породы используются хвойные.</p>
        <p>Преимущества дома из рубленного бревна, объясняющие его популярность</p>
        <ul class="list-style list-decimal">
            <li>Энергоэффективность. Теплопроводность дерева низкая, что гарантирует тепло внутри дома зимой и прохладу летом. Воздух беспрепятственно циркулирует.</li>
            <li>Здоровый микроклимат. Натуральная древесина, в отличие от современных материалов искусственного происхождения, не только безопасна, но и полезна. Выделяемые ею смолы благотворно влияют на самочувствие и общее здоровье.</li>
            <li>Эстетика. Качественно построенные рубленные дома из бревна красивы снаружи, уютные внутри. Первоначальная красота древесины сохраняется годами, если ее обрабатывать специальными пропитками. Сохранить природную красоту помогает лаковое покрытие.</li>
            <li>Надежность. Служат дома ручной рубки десятилетиями, хлопот не доставляют, так как их обслуживание отличается простотой. Увеличение срока эксплуатации обеспечивается новейшими методами обработки древесины.</li>
        </ul>
        <div class="custom-alert"><div class="info-label"><i class="fa fa-home" aria-hidden="true"></i></div><div class="custom-info">Мы профессионалы в строительстве рубленных домов из бревна.</div></div>
        <p>Особенности строительства рубленного дома из бревна</p>
        <ul class="list-style list-square">
            <li>Процесс монтажа рубленного дома сложный, качественно возвести сруб дома из рубленного бревна своими руками не удастся;</li>
            <li>Заселение рекомендовано через 1-2 года, столько времени необходимо на усадку;</li>
            <li>Невозможность перепланировки. Учитывайте это, составляя проект будущего дома;</li>
            <li>Высокая стоимость. Качественное бревно и работа профессионалов стоят дорого, но окупаются за счет долгого срока эксплуатации и комфорта.</li>
        </ul>
        <p>Подготовим проект, выполним строительство домов из рубленного бревна на вашем участке в соответствии с каждым из пунктов договора. Обращайтесь, профессиональные строители из компании «Сруб-Строй» готовы к работе!</p>
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