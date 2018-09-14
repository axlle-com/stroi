<?

namespace frontend\widgets;

use frontend\components\Common;
use common\models\Subscribe;
use yii\bootstrap\Widget;

class SubscribeWidget extends  Widget{

    public function run(){
        $model = new Subscribe();

        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            if($model->save()){
                \Yii::$app->session->setFlash('messageSubscribe','Подписка оформлена.');
            }else {
                \Yii::$app->session->setFlash('errorSubscribe', 'Произошла ошибка.Ваше сообщение не отправлено.');
            }
        }
        return $this->render("subscribe", ['model' => $model]);
    }
}