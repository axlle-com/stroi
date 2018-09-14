<?php

namespace frontend\controllers;

use common\components\Common;
use common\models\Reviews;
use common\models\Tags;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Category;
use common\models\Item;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Response;
use yii\widgets\ActiveForm;
use frontend\filters\FilterCategory;
use frontend\filters\FilterItem;
use frontend\filters\FilterAll;
use yii\base\DynamicModel;
use yii\data\Pagination;
use yii\web\HttpException;

class SitemapController extends Controller
{

    public function actionIndex()
    {

        if (!$xml_sitemap = Yii::$app->cache->get('sitemap')) {  // проверяем есть ли закэшированная версия sitemap
            $urls = array();

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
            
            $xml_sitemap = $this->renderPartial('index', array( // записываем view на переменную для последующего кэширования
                'host' => Yii::$app->request->hostInfo,         // текущий домен сайта
                'urls' => $urls,                                // с генерированные ссылки для sitemap
            ));

            Yii::$app->cache->set('sitemap', $xml_sitemap, 3600*12); // кэшируем результат, чтобы не нагружать сервер и не выполнять код при каждом запросе карты сайта.

        }
        header('Content-Type: application/xml');
        Yii::$app->response->format = \yii\web\Response::FORMAT_XML; // устанавливаем формат отдачи контента

        echo $xml_sitemap;
    }
}