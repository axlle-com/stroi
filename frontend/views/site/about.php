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
    <p></p>
    <p></p>
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
        <p>В статье <a href="/otdelka-derevyannogo-doma.htm">«Отделка деревянного дома»</a> мы рассуждали о необходимости отделки деревянных домов как таковой и сделали вывод, что отделка по большей части нужна. </p>
        <p>Исключение можно сделать для домов из оцилиндрованного бревна или домов из клееного и профилированного бруса с оговоркой, что сечение бревна и бруса должно быть достаточным для обеспечения комфортного температурного режима в данной климатической зоне. И, разумеется, в любом случае, независимо от толщины стен, требуется обработка антисептиками, антипиренами и средствами защиты от воздействия окружающей среды.</p>
        <p>В случае, если дом построен из нетолстого окоренного бревна или обычного бруса естественной влажности, наружная отделка деревянного дома будет нужна для утепления жилища и для обеспечения привлекательного внешнего вида.</p>
        <p>Нелишним будет напомнить, что отделку деревянного дома следует начинать только после усадки. Период усадки может варьироваться от 6 до 18 месяцев в зависимости от материала и толщины стен. Дело в том, что в период усадки линейные размеры стен изменяются довольно сильно, что может привести к деформации облицовочных материалов, либо увеличению щелей между венцами сруба.</p>
        <div class="custom-info-block">
            <p>Компания «Сруб-Строй» начала применять технологию, позволяющую начинать отделку практически сразу же после возведения сруба. Суть технологии заключается в том, что отсортированная по диаметрам древесина, окоряется, складывается в клетки и в течение 3-х месяцев сохнет естественным образом. Торцы бревен замазываются. Это делается для того, чтобы влага из бревна уходила постепенно. Это позволяет получить сухое бревно быстро и практически без трещин.</p>
        </div>
        <h2>Порядок наружной отделки деревянного дома</h2>
        <p>Итак, новый деревянный дом, возведенный под усадку простоял нужное время и готов к отделке.</p>
        <p>Принято считать, что отделка деревянного дома ведется сверху вниз. Поэтому первое, что необходимо сделать – крыша.</p>
        <p>Устройство крыши – этап весьма ответственный. От того, насколько правильно и качественно сделана крыша, зависит долговечность всего дома. Поэтому для проведения кровельных работ мы бы рекомендовали обратиться к специалистам компании «Сруб-Строй».</p>
        <p>Материалов для кровли на сегодняшний день существует множество. У всех из них есть свои достоинства и недостатки. Чаще всего используют ондулин, металлочерепицу, профнастил, гибкую черепицу и даже цементно-песчаную черепицу. Последняя выглядит очень эффектно, как бы подчеркивая хороший вкус хозяина, однако требует усиленной стропильной системы в силу своего немалого веса.</p>
        <p>Крыша обязательно должна утепляться. Толщина утеплителя берется в среднем 150-250 мм. Должны присутствовать вентиляционные зазоры, которые не дадут влаге разрушить деревянные конструкции крыши прежде времени.</p>
        <p>Изнутри скаты крыши чаще всего обшивают имитацией бревна или бруса. Кто-то использует вагонку. Более подробно об устройстве крыши можно почитать в отдельной статье (будет ссылка).</p>
        <p>Переходим к стенам. В первую очередь, естественно, необходимо обработать стены эмульсиями, которые защищают стены вашего дома от насекомых, плесени и повышают устойчивость древесины к огню. В настоящее время химической промышленностью разработано огромное количество всевозможных пропиток – так, что проблем с выбором не будет.</p>
        <p>Следующий этап – конопатка. Межвенцовый уплотнитель можно использовать разный: лён, пакля, пенька, джут, болотный мох. Они (кроме мха) продаются лентами разной ширины. Единственное – не следует, пожалуй, использовать х/б или шерстяные уплотнители. Они хоть и удерживают тепло, но имеют неприятное свойство накапливать влагу и в них прекрасно себя чувствуют насекомые. Уплотнитель укладывается между венцами еще на этапе сборки сруба.</p>
        <p>Конопатка ведется с низу вверх по одному пазу снаружи и изнутри по всему периметру дома с тем, чтобы обеспечить равномерный подъем венцов. Да, да – после конопатки стены высотой 3 метра могут «подрасти» на несколько сантиметров. Через некоторое время пазы уплотнятся и размер вернется. Время зависит в том числе и от типа используемой кровли – масса с которой крыша «давит» на сруб.</p>
        <p>Далее нужно позаботиться о том, чтобы в доме был благоприятный микроклимат, чтобы дом «дышал». Поэтому закрываем сруб пароизоляционной пленкой. Выбор пленок для пароизоляции тоже большой. Специалисты компании «Сруб-Строй» могут дать рекомендации по выбору.</p>
        <p>Пришло время утеплить стены дома снаружи. Поверх паро-изоляции монтируется каркас для утеплителя. Сделать его можно из тонкого бруса или использовать металлический, который производит промышленность. Необходимо как следует закрепить каркас, т.к. позже на него будет монтироваться каркас для декоративной обшивки. Разновидностей материалов для утепления тоже великое множество. Конкретно какую-то марку выделить сложно. Лучше всего проконсультироваться у продавцов или сотрудников компании «Сруб-Строй». Толщины 50 мм. обычно вполне достаточно для наружной стороны стен.</p>
        <p>Поверх теплоизоляции закрываем стены сруба влагонепроницаемой пленкой для того, чтобы исключить попадание влаги.</p>
        <p>На каркас утеплителя монтируем каркас для обшивки. Конструкция каркаса зависит от того, какой вид облицовки вы решили применить.</p>
        <p>На сегодняшний день для отделки деревянных домов чаще всего используют следующие материалы:</p>
        <ul class="list-style list-square">
            <li>Натуральная доска;</li>
            <li>Рейка;</li>
            <li>Вагонка;</li>
            <li>Блок-хаус;</li>
            <li>Пластиковый или металлический сайдинг;</li>
            <li>Декоративный или натуральный камень;</li>
            <li>Различные варианты стеновых панелей.</li>
        </ul>
        <p>У всех вариантов отделки есть свои плюсы и минусы. Впрочем, как и у всего в этом мире есть обратная сторона медали. Не стесняйтесь задавать вопросы – от вашего решения будет зависеть насколько комфортно будет проживание в вашем деревянном доме.</p>
        <p>Обратившись для отделки вашего деревянного дома в компанию «Сруб-Строй», вы можете быть уверены, что специалисты компании приедут на объект, кропотливо исследуют дом на предмет возможных дефектов и помогут выбрать оптимальный для вашего дома вариант отделки.</p>
    </div>
    
    
    <?php
    $item = Common::getHotPrice();
    $cnt = 0;
    $cnt1 = 0;
    ?>
    <div class="col-md-2">
    <?php foreach ($item['item'] as $i){
        $cnt++;
        echo $cnt.'.'.$i->position.'<br>';
    }?>
    </div><div class="col-md-2">
    <?php foreach ($item['details'] as $j){
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
        <?php foreach($urls as $url): ?>
            <li><a href="<?= Yii::$app->request->hostInfo . $url[0] ?>" target="_blank"><?= Yii::$app->request->hostInfo . $url[0] ?></a></li>
        <?php endforeach; ?>
    </ul>

</div>