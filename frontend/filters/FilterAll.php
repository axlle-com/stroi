<?php

namespace frontend\filters;
use Yii;
use common\components\Common;
use common\models\Category;
use common\models\Item;
use yii\base\ActionFilter;
use yii\web\HttpException;


class FilterAll extends ActionFilter
    {

        public function beforeAction($action)
        {
            //$model_cat = Common::getTitlePage('category')['model'];

            $absoluteUrl = Yii::$app->request->absoluteUrl;
            $host = Yii::$app->request->hostInfo.'/'.Yii::$app->request->getPathInfo();
            $sort = Yii::$app->request->queryString;

            if (strpos($absoluteUrl, 'index.php')) {
                throw new HttpException(404 ,'Страница не найдена...');
            }
            /*if ($absoluteUrl != $host) {
                if(strpos($sort, 'sort') !== false){
                    return parent::beforeAction($action);
                }else{
                    throw new HttpException(404 ,'Страница не найдена...!'.$sort);
                }

            }*/

            return parent::beforeAction($action);

        }


        public function afterAction($action,$result){
            return parent::afterAction($action,$result);
        }


    }