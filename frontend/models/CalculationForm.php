<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * CalculationForm is the model behind the CalculationForm form.
 */
class CalculationForm extends Model
{
    public $place;
    public $type;
    public $floors;
    public $width;
    public $length;

    public $basement;

    public $garage;
    public $bathhouse;
    public $pavilion;
    public $well;
    public $hangar;

    public $fifth_wall;
    public $chopped_gables;
    public $prostrozhka_plane;
    public $chopped_terrace;
    public $oriel;
    public $porch;
    public $balcony;
    public $second_light;
    public $boiler_room;
    public $antiseptic;
    public $sixth_wall;

    public $light;
    public $water;
    public $cabins;
    public $shop;
    public $nothing;

    public $name;
    public $email;
    public $phone;
    public $body;
    public $verifyCode;

    public $agreement;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email','phone', 'place', 'agreement', 'body','width', 'length', 'type', 'floors', 'basement'], 'required'],//
            [['garage', 'bathhouse', 'pavilion', 'well', 'hangar', 'fifth_wall', 'chopped_gables', 'prostrozhka_plane',
            'chopped_terrace', 'oriel', 'porch', 'balcony', 'second_light' , 'boiler_room', 'light', 'water', 'cabins', 'shop', 'nothing','antiseptic','sixth_wall'], 'integer'],
            // email has to be a valid email address
            ['email', 'email'],
            ['agreement', 'compare', 'compareValue' => 1, 'message' => 'Примите соглашение, иначе форма не отправится!'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'agreement' => 'соглашение',
            'place' => 'Укажите место строительства',
            'type' => 'Выберите тип желаемой постройки',
            'floors' => 'Выберите этажность',
            'width' => 'ширина',
            'length' => 'длина',
            'basement' => 'Нужен ли фундамент?',

            'garage' => 'Гараж',
            'bathhouse' => 'Баня',
            'pavilion' => 'Беседка',
            'well' => 'Колодец',
            'hangar' => 'Сарай',

            'fifth_wall' => 'Пятая стена',
            'chopped_gables' => 'Рубленые фронтоны',
            'prostrozhka_plane' => 'Обработка рубанком',
            'chopped_terrace' => 'Рубленная терраса',
            'oriel' => 'Эркер',
            'porch' => 'Крыльцо',
            'balcony' => 'Балкон',
            'second_light' => 'Второй свет',
            'boiler_room' => 'Котельная',
            'antiseptic' => 'Обработка антисептиком',
            'sixth_wall' => 'Шестая стена',

            'light' => 'Свет',
            'water' => 'Вода',
            'cabins' => 'Жилье для строителей (бытовка)',
            'shop' => 'Магазин поблизости',
            'nothing' => 'Ничего нет',

            'verifyCode' => 'Введите символы',
            'name' => 'Ваше имя',
            'email' => 'Ваш E-mail',
            'phone' => 'Ваш номер телефона',
            'body' => 'Текст письма',

        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            //->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
