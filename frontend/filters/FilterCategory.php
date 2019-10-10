<?

namespace frontend\filters;
use Yii;
use common\components\Common;
use common\models\Category;
use common\models\Item;
use yii\base\ActionFilter;
use yii\web\HttpException;
use yii\helpers\Url;

class FilterCategory extends ActionFilter
{

    public function beforeAction($action)
    {
        $absoluteUrl = Yii::$app->request->absoluteUrl;

        if ((strpos($absoluteUrl, 'index.php') !== false)) {
            throw new HttpException(404 ,'Страница не найдена..');
        }
        $model = Common::getTitlePage('category')['model'];
        $item = Common::getTitlePage('category')['item'];

        if($model == null)
        {
            if($item)
            {
                return true;
                //return \Yii::$app->getResponse()->redirect('/'.$item->category->alias_category.'/'.$item->alias_item.'.htm', 301)->send();
            }else{
                throw new  HttpException(404,'Неизвестная категория');
                return false;
            }

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