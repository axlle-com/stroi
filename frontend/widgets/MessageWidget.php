<?php

namespace frontend\widgets;

use Yii;
use common\components\Common;
use frontend\models\ContactForm;
use yii\bootstrap\Widget;
use yii\web\Cookie;
use yii\web\UploadedFile;
/**
 * Created by PhpStorm.
 * User: axlle
 * Date: 07.07.2017
 * Time: 20:42
 */
class MessageWidget extends  Widget{

    public function run(){
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $body = " <div>Страница: <b> ".$model->operation." </b></div>";
            $body .= " <div>IP: <b> ".Yii::$app->request->userIP." </b></div>";
            $body .= " <div>Тема: <b> ".$model->subject." </b></div>";
            $body .= " <div>Имя: <b> ".$model->name." </b></div>";
            $body .= " <div>Телефон: <b> ".$model->phone." </b></div>";
            $body .= " <div>Email: <b> ".$model->email." </b></div>";
            $body .= " <div>Соглашение: <b> ".$model->agreement." </b></div>";
            $body .= " <div>Текст: <b> ".$model->body." </b></div>";
            if ($name = $model->upload($model)) {
                $body .= " <div>Изображение: <b> есть </b></div>";
                // file is uploaded successfully
            }else{
                $body .= " <div>Изображение: <b> нет </b></div>";
            }
            $cookie = $_COOKIE['srbstr'];
            $cookie = (int)$cookie;
            if ($cookie && Common::getBlack(Yii::$app->request->userIP,$model->name,$model->phone,$model->email,$model->body) && \Yii::$app->common->sendMail($model->subject,$body,$name)) {
                Yii::$app->session->setFlash('successMessage', 'Спасибо. Ваше сообщение отправлено');
            } else {
                Yii::$app->session->setFlash('errorMessage', 'Произошла ошибка.Ваше сообщение не отправлено.!');
            }
        }
        return $this->render('message', [
            'model' => $model,
        ]);

    }
}