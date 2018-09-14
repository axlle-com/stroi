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

class UrlRuleFrontend implements UrlRuleInterface
    {

        public function parseRequest($manager, $request)
        {
        }
        public function createUrl($manager, $route, $params)
        {
            if ($route)
            {
                return $route.'.htm';
            }
            return false;
        }
    }