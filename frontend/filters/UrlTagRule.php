<?

namespace frontend\filters;
use common\models\Tags;
use Yii;
use common\components\Common;
use common\models\Category;
use common\models\Item;
use yii\base\ActionFilter;
use yii\web\HttpException;
use yii\web\UrlRuleInterface;

class UrlTagRule implements UrlRuleInterface
    {
        //public $urlSuffix = '.htm';

        public function parseRequest($manager, $request)
        {
            $pathInfo = $request->getPathInfo();
            preg_match('#.htm(.*)#i', $pathInfo, $matches);
            if ($matches[1]){
                return false;
            }

            if (preg_match('#^([\w_-]+)\/([\w_-]+)\/Page-(\d+).htm#i', $pathInfo, $matches)){
                $page = Tags::findOne([
                    'alias_category' => $matches[1],
                    'alias_tags' => $matches[2],
                ]);
                if ($page !== null) {
                    $params = [
                        'alias_category' => $matches[1],
                        'alias_tags' => $matches[2],
                        'page' =>$matches[3],
                    ];
                    return ['site/tags',$params];
                }
            }
            if (preg_match('#^([\w_-]+)\/([\w_-]+).htm#i', $pathInfo, $matches)) {
                //$page = Item::findOne(['alias_item' => $matches[2]]);
                $page = Tags::findOne([
                    'alias_category' => $matches[1],
                    'alias_tags' => $matches[2],
                ]);
                if ($page !== null) {
                    $params = [
                        'alias_category' => $matches[1],
                        'alias_tags' => $matches[2],
                    ];
                    return ['site/tags',$params];
                }
            }
            return false;
        }
        public function createUrl($manager, $route, $params)
        {
            if ($route == 'site/tags')
            {
                if (isset($params['alias_category']) && isset($params['alias_tags']))
                {
                    if ($page = Tags::findOne(['alias_category' => $params['alias_category'],'alias_tags' => $params['alias_tags']]))
                    {
                        if(isset($params['page'])){
                            return $params['alias_category'].'/'.$params['alias_tags'].'/Page-'.$params['page'].'.htm';
                        }else{
                            return $params['alias_category'].'/'.$params['alias_tags'].'.htm';
                        }
                    }
                }
            }
            return false;
        }
    }