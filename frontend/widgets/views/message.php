<?php

use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\captcha\Captcha;
/**
 * Created by PhpStorm.
 * User: axlle
 * Date: 07.07.2017
 * Time: 20:43
 */
?>
    <? Pjax::begin([
        // Pjax options
    ]);?>
    <? if (Yii::$app->session->hasFlash('successMessage'))
    {
        $success = Yii::$app->session->getFlash('successMessage');
        echo \yii\bootstrap\Alert::widget([
            'options' => [
                'class' => 'alert-info'
            ],
            'body' => $success
        ]);
    }elseif (Yii::$app->session->hasFlash('errorMessage')){
        $error = Yii::$app->session->getFlash('errorMessage');
        echo \yii\bootstrap\Alert::widget([
            'options' => [
                'class' => 'alert-danger'
            ],
            'body' => $error
        ]);
    }else
    {
        $form = ActiveForm::begin([
            'options' => ['data' => ['pjax' => true]],
            // остальные опции ActiveForm
        ]);?>

        <div class="row">
            <div class="col-md-6">
            <? echo $form->field($model, 'subject')->textInput(['placeholder' => 'Тема','class'=>'form-control input-border-bottom']) ->label(false);?>
            </div>
            <div class="col-md-6">
        <? echo $form->field($model, 'name')->textInput(['placeholder' => 'Ваше имя','class'=>'form-control input-border-bottom'])->label(false);?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <? echo $form->field($model, 'email')->textInput(['placeholder' => 'Ваш E-mail','class'=>'form-control input-border-bottom'])->label(false) ;?>
            </div>
            <div class="col-md-6">
                <? echo $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => '+7 (999) 999-99-99',
                        'options' => [
                            'class'=>'form-control input-border-bottom',
                            'placeholder' => '+7(999)999-99-99',
                        ]

                    ])->label(false);?>
            </div>
        </div>

        <? echo $form->field($model, 'operation')->hiddenInput(['value' => \common\components\Common::getTitlePage('item')['title']])->label(false);?>

        <? echo $form->field($model, 'body')->textarea(['rows' => 5,'class'=>'form-control input-border-bottom'])->label(false);?>
        <?= $form->field($model, 'imageFile')->fileInput(['class'=>'form-control no-radius']) ?>
        <? echo $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
        ])
        ?>
        <div class="sky-form"><? echo $form->field($model, 'agreement')->checkbox([
                'label' => '<i></i>Согласен на обработку персональных данных',
                'labelOptions' => [
                    'class' => 'checkbox'
                ],
            ]);?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-custom2 btn-border btn-block no-radius', 'name' => 'contact-button']) ?>
        </div>

        <? ActiveForm::end();?>


        
    <?}
    Pjax::end();?>
        <div class="personal_dan">
            <a href="/documents/personal_dan.pdf" target="_blank">Согласие на обработку персональных данных</a>
        </div>