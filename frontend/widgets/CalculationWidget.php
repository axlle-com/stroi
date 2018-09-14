<?php

namespace frontend\widgets;

use Yii;
use common\components\Common;
use frontend\models\CalculationForm;
use yii\bootstrap\Widget;
/**
 * Created by PhpStorm.
 * User: axlle
 * Date: 07.07.2017
 * Time: 20:42
 */
class CalculationWidget extends  Widget{

    public function run(){
        $model = new CalculationForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $body = " <div>Имя: <b> ".$model->name." </b></div>";
            $body .= "<div>Телефон: <b> ".$model->phone." </b></div>";
            $body .= "<div>Email: <b> ".$model->email." </b></div>";
            $body .= "<div>Место строительства: <b> ".$model->place." </b></div>";
            $body .= "<div>Тип желаемой постройки: <b> ".$model->type." </b></div>";
            $body .= "<div>Этажность: <b> ".$model->floors." </b></div>";
            $body .= "<div>Ширина: <b> ".$model->width." </b></div>";
            $body .= "<div>Длина: <b> ".$model->length." </b></div>";
            $body .= "<div>Нужен ли фундамент: <b> ".$model->basement." </b></div>";
            $body .= "<div>Что необходимо дополнительно к дому: <b> ";
                if($model->garage){$body .="Гараж, ";}
                if($model->bathhouse){$body .="Баня, ";}
                if($model->pavilion){$body .="Беседка, ";}
                if($model->well){$body .="Колодец, ";}
                if($model->hangar){$body .="Сарай, ";}
                if($model->fifth_wall){$body .="Пятая стена, ";}
                if($model->chopped_gables){$body .="Рубленые фронтоны, ";}
                if($model->prostrozhka_plane){$body .="Обработка рубанком, ";}
                if($model->chopped_terrace){$body .="Рубленная терраса, ";}
                if($model->oriel){$body .="Эркер, ";}
                if($model->porch){$body .="Крыльцо, ";}
                if($model->balcony){$body .="Балкон, ";}
                if($model->second_light){$body .="Второй свет, ";}
                if($model->boiler_room){$body .="Котельная, ";}
                if($model->antiseptic){$body .="Обработка антисептиком, ";}
                if($model->sixth_wall){$body .="Шестая стена, ";}
            $body .="</b></div>";
            $body .= "<div>Что уже есть на участке: <b> ";
                if($model->light){$body .="Свет, ";}
                if($model->water){$body .="Вода, ";}
                if($model->cabins){$body .="Жилье для строителей (бытовка), ";}
                if($model->shop){$body .="Магазин поблизости, ";}
                if($model->nothing){$body .="Ничего нет";}
            $body .="</b></div>";
            $body .= "<div>Комментарий: <b> ".$model->body." </b></div>";
            $body .= "<div>Соглашение: <b> ";
                if($model->agreement){$body .="Принято";}
            $body .= "</b></div>";
            $cookie = $_COOKIE['srbstr'];
            $cookie = (int)$cookie;
            if ($cookie && \Yii::$app->common->sendMail($model->place,$body)) {
                Yii::$app->session->setFlash('calculationMessage', 'Спасибо.Ваша заявка отправлена. Мы свяжемся с вами в ближайшее время.');
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка.Ваша заявка не отправлена.');
            }
        }
        return $this->render('calculation', [
            'model' => $model,
        ]);

    }
}