<?php

namespace frontend\filters;
use Yii;
use common\components\Common;
use common\models\Category;
use common\models\Item;
use yii\base\ActionFilter;
use yii\web\HttpException;


class FilterItem extends ActionFilter
    {

        public function beforeAction($action)
        {
            $model_cat = Common::getTitlePage('category')['model'];
            $absoluteUrl = Yii::$app->request->absoluteUrl;

            if (strpos($absoluteUrl, 'index.php')) {
                throw new HttpException(404 ,'Страница не найдена....');
            }

            $model = Common::getTitlePage('item')['model'];

            if($model == null || !$model->sitemap)
            {
                throw new  HttpException(404,'Материал не найден');
                return false;
            }
            elseif ($model_cat && !$model_cat->sitemap)
            {
                throw new  HttpException(404,'Неизвестная категория');
                return false;
            }
            elseif ($model_cat == null)
            {
                if($model != null)
                {
                    if($model->category->sitemap)
                    {
                        return \Yii::$app->getResponse()->redirect('/'.$model->category->alias_category.'/'.$model->alias_item.'.htm', 301)->send();
                    }
                    elseif (!$model->category->sitemap && $model->category->published)
                    {
                        return true;
                    }
                }else{
                    throw new  HttpException(404,'Неизвестная категория');
                    return false;
                }

            }



            return parent::beforeAction($action);

        }


        public function afterAction($action,$result){
            return parent::afterAction($action,$result);
        }


    }