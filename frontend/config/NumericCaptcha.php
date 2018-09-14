<?php

namespace frontend\config;

use yii\captcha\CaptchaAction as DefaultCaptchaAction;

class NumericCaptcha extends DefaultCaptchaAction
{
    protected function generateVerifyCode()
    {
        //Длина
        $length = 6;

        //Цифры, которые используются при генерации
        $digits = '0123456789';

        $code = '';
        for($i = 0; $i < $length; $i++) {
            $code .= $digits[mt_rand(0, 9)];
        }
        return $code;
    }
}