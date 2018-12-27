    <?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;
$request_page = Yii::$app->request->get(trim('page'));
if($request_page && $request_page != 1){
    $this->registerLinkTag(['rel' => 'canonical', 'href' => Url::to('@web/'.$category->alias_category.'/Page-'.$request_page.'.htm', true)]);
    if($category->semanticos){
        foreach($category->semanticos as $row){
            if($row->key_name == $request_page){
                $description = $row->description;
                $title_seo = $row->title_seo;
                $description_seo = $row->description_seo;
            }
        }
    }
}else{
    $this->registerLinkTag(['rel' => 'canonical', 'href' => Url::to('@web/'.$category->alias_category.'.htm', true)]);
    $description = $category->description;
    $title_seo = $category->title_seo;
    $description_seo = $category->description_seo;
}
$this->registerMetaTag([
    'name' => 'description',
    'content' => $description_seo,
]);
$this->title = $title_seo;
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('https://api-maps.yandex.ru/2.1/?lang=ru_RU');
$this->registerJsFile('/js/map.js');

?>
<div id="map"></div>
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-push-3">
            <article class="price-one">
                <h1 class="title-underblock custom"><?=$category->title?></h1>
                <div class="entry-content">
                    <div class="blog-content">

                        <p>Уважаемые застройщики, задать нам вопросы по поводу строительства рубленных домов и бань, сделать заказ Вы можете, позвонив по телефонам или отправить сообщение через форму, находящуюся ниже на странице:</p>
                        <ul class="fa-ul">
                            <li><i class="fa fa-address-card-o" aria-hidden="true"></i><strong>Директор: </strong>Ярыгин Максим Валерьевич</li>
                            <li><i class="fa fa-phone" aria-hidden="true"></i><strong>Телефон моб.(WhatsApp,Viber): </strong>+7 (915) 91-000-55</li>
                        </ul>
                        <ul class="fa-ul">
                            <li><i class="fa fa-address-card-o" aria-hidden="true"></i><strong>Инженер по строительству: </strong>Соболев Александр Юрьевич</li>
                            <li><i class="fa fa-phone" aria-hidden="true"></i><strong>Телефон: </strong>+7 (495) 997 10 78 (Заключение договоров, приемка объектов, консультации и курирование строительства на объектах, сметчик.)</li>
                        </ul>
                        <div class="custom-info-block">
                            <div class="info-label"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                            <div class="custom-info">
                                <h2>Режим работы</h2>
                                <ul class="fa-ul">
                                    <li><i class="fa fa-check-square" aria-hidden="true"></i>Понедельник – воскресенье 09:00-20:00</li>
                                    <li><i class="fa fa-check-square" aria-hidden="true"></i>Без перерывов и выходных</li>
                                    <li><i class="fa fa-check-square" aria-hidden="true"></i>Звонки принимаются с 09:00 до 20:00</li>
                                </ul>
                            </div>
                        </div>

                        <ul class="fa-ul">
                            <li><i class="fa fa-map-marker" aria-hidden="true"></i><strong>Производство: </strong>Костромская область, г. Чухлома.</li>
                            <li><i class="fa fa-map-marker" aria-hidden="true"></i><strong>Адрес офиса: </strong>г. Москва, ул. Коммунистическая, д.25Г (предварительная запись).</li>
                            <li><i class="fa fa-map-marker" aria-hidden="true"></i><strong>Адрес офиса: </strong>г. Мытищи, ул. Ярославское шоссе, территория Тракт-терминала (предварительная запись).</li>
                        </ul>
                    </div>
                </div>
                <button class="btn btn-custom2 btn-border no-radius button-message message-catalog" data-toggle="modal" data-target="#modal-contact-form-advanced">
                    Написать нам
                </button>
            </article>
            <div class="mb30 visible-sm visible-xs"></div><!-- space -->
        </div>
        <aside class="col-md-3 col-md-pull-9 sidebar" role="complementary"  >
            <? echo $this->render("//inc/leftBlog") ?>
        </aside><!-- End .col-md-3 -->
    </div>
</div>

<div class="modal fade" id="modal-contact-form-advanced" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="myModalLabel5">Написать нам</h3>
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