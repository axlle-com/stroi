<?php

namespace frontend\filters;
use common\models\Tags;
use Yii;
use common\components\Common;
use common\models\Category;
use common\models\Item;
use yii\base\ActionFilter;
use yii\web\HttpException;
use yii\web\UrlRuleInterface;

class UrlUncategorizedRule implements UrlRuleInterface
    {
        public function parseRequest($manager, $request)
        {
            $pathInfo = $request->getPathInfo();
            preg_match('#.htm(.*)#i', $pathInfo, $matches);
            if ($matches[1])
            {
                return false;
            }
            if (preg_match('#^([\w_-]+).htm#i', $pathInfo, $matches))
            {
                $category = Category::find()
                    ->select('id')
                    ->where(['sitemap' => 0])
                    ->andWhere(['published' => 1])
                    ->asArray();

                $page = Item::findAll([
                    'category_id' => $category,
                    'alias_item' => $matches[1],
                ]);
                if ($page) {
                    $params = [
                        'alias_item' => $matches[1],
                    ];
                    return ['site/item',$params];
                }
            }
            return false;
        }
        public function createUrl($manager, $route, $params)
        {
            if ($route == 'site/item')
            {
                if (!isset($params['alias_category']) && isset($params['alias_item']))
                {
                    $category = Category::find()
                        ->select('id')
                        ->where(['sitemap' => 0])
                        ->andWhere(['published' => 1])
                        ->asArray();
                    if ($page = Item::findAll(['category_id' => $category,'alias_item' => $params['alias_item']]))
                    {
                        return $params['alias_item'] . '.htm';
                    }
                }
            }
            return false;
        }
    }