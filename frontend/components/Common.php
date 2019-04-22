<?
namespace frontend\components;

use yii\base\Component;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;

class Common extends Component{

    const EVENT_NOTIFY = 'notify_admin';

    public function sendMail($subject,$text,$name = ''){
        if(\Yii::$app->mail->compose()
            ->setFrom(['web@srub-stroi.ru' => 'Сообщение с сайта'])
            ->setTo(['mail@srub-stroi.ru' => 'ООО "Сруб-Строй"'])
            ->setSubject($subject)
            ->setHtmlBody($text)
            ->attach($name)
            ->send()){
            return true;
        }
        return false;
    }

    public function notifyAdmin($event){

        print "Notify Admin";
    }
    public static function substr($text,$start=0,$end=50){

        return mb_substr($text,$start,$end);
    }


}