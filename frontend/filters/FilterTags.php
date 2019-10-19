<?php

namespace frontend\filters;
use Yii;
use common\components\Common;
use common\models\Category;
use common\models\Item;
use common\models\Tags;
use yii\base\ActionFilter;
use yii\web\HttpException;
use yii\helpers\Url;

class FilterTags extends ActionFilter
{

    public function beforeAction($action)
    {
        $absoluteUrl = Yii::$app->request->absoluteUrl;
        $pathInfo = Yii::$app->request->getPathInfo();
        $pathInfo1 = Yii::$app->request->queryString;


        if ((strpos($absoluteUrl, 'index.php') !== false)) {
            throw new HttpException(404 ,'Страница не найдена..');
        }
        $alias_category = Yii::$app->request->get(trim('alias_category'));
        $alias_tags = Yii::$app->request->get(trim('alias_tags'));
        $model = Tags::find()->where(['alias_category' => $alias_category])->andWhere(['alias_tags' => $alias_tags])->one();

        if(1)//$model == null
        {
            preg_match('#.htm(.*)#i', $pathInfo, $matches);
            throw new  HttpException(404,'Неизвестная категория+'.'+'.$matches[1]);
            return false;
        }elseif (!$model->sitemap)
        {
            throw new  HttpException(404,'Неизвестная категория');
            return false;
        }

        return parent::beforeAction($action);

    }


    public function afterAction($action,$result){
        return parent::afterAction($action,$result);
    }


}