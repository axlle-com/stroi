<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;

/**
 * ContactForm is the model behind the contact form.
 */
class QuestionForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $operation;
    public $body;
    public $verifyCode;
    public $imageFile;
    public $agreement;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email','phone', 'subject','operation', 'body'], 'required'],
            // email has to be a valid email address
            [['body'], 'string', 'max' => 500],
            ['email', 'email'],
            ['agreement', 'compare', 'compareValue' => 1, 'message' => 'Примите соглашение, иначе форма не отправится!'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg,jpeg'],
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
            'verifyCode' => 'Введите символы',
            'name' => 'Ваше имя',
            'email' => 'Ваш E-mail',
            'phone' => 'Ваш номер телефона',
            'subject' => 'Тема письма',
            'body' => 'Текст письма',
            'imageFile' => '',
        ];
    }
    public function upload($model)
    {
        if (1) {//$this->validate()
            $this->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $path = Yii::getAlias('@frontend/web/images/uploads/');
            //BaseFileHelper::createDirectory($path);
            $name = 0;
            if($this->imageFile){
                $name = $path . $this->imageFile->baseName . '-' . time(). '.' . $this->imageFile->extension;
                $this->imageFile->saveAs($name);
            }
            return $name;
        } else {
            return false;
        }
    }
    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        $message = Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
        $message->attachContent('Attachment content', ['fileName' => 'attach.txt', 'contentType' => 'text/plain']);

        return $message;
    }
}
