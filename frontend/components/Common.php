<?
namespace frontend\components;

use yii\base\Component;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;

class Common extends Component{

    public function sendMail($subject,$text,$name = ''){
        if(\Yii::$app->mail->compose()
            ->setFrom(\Yii::$app->params['emailFrom'])
            ->setTo(\Yii::$app->params['emailTo'])
            ->setSubject($subject)
            ->setHtmlBody($text)
            ->attach($name)
            ->send()){
            return true;
        }
        return false;
    }

    public static function substr($text,$start=0,$end=50){

        return mb_substr($text,$start,$end);
    }
}