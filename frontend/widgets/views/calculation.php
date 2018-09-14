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

    <div class="calculation">
    <? Pjax::begin([
        // Pjax options
    ]);?>
    <? if (Yii::$app->session->hasFlash('calculationMessage'))
    {
        $success = Yii::$app->session->getFlash('calculationMessage');
        echo \yii\bootstrap\Alert::widget([
            'options' => [
                'class' => 'alert-info'
            ],
            'body' => $success
        ]);
    }else
    {
        $form = ActiveForm::begin([
            'options' => ['data' => ['pjax' => true]],
            // остальные опции ActiveForm
        ]);?>

        <div class="row calc-section">
            <div class="col-md-6">
            <? echo $form->field($model, 'place')->textInput(['placeholder' => 'Укажите место строительства','class'=>'form-control no-radius']) ->label(false);?>
            <? echo $form->field($model, 'width')->textInput(['placeholder' => 'Ширина постройки','class'=>'form-control no-radius']) ->label(false);?>
            <? echo $form->field($model, 'length')->textInput(['placeholder' => 'Длина постройки','class'=>'form-control no-radius']) ->label(false);?>
            </div>
            <div class="col-md-6">
                <?$items = [
                    'Дом или баня из бруса 150х150 мм.' => 'Дом или баня из бруса 150х150 мм.',
                    'Дом или баня из бруса 150х200 мм.' => 'Дом или баня из бруса 150х200 мм.',
                    'Дом или баня из профилированного бруса 145х145 мм.'=>'Дом или баня из профилированного бруса 145х145 мм.',
                    'Дом или баня из профилированного бруса 145х190 мм.'=>'Дом или баня из профилированного бруса 145х190 мм.',
                    'Дом или баня из бревна диаметром от 22 см.'=>'Дом или баня из бревна диаметром от 22 см.',
                ];
                $params = [
                    'prompt' => 'Выберите тип желаемой постройки...'
                ];
                echo $form->field($model, 'type')->dropDownList($items,$params)->label(false);?>
                <?$items = [
                    'Один этаж' => 'Один этаж',
                    'Один этаж с мансардой' => 'Один этаж с мансардой',
                    'Полтора этажа' => 'Полтора этажа',
                    'Два этажа' => 'Два этажа',
                ];
                $params = [
                    'prompt' => 'Выберите этажность...'
                ];
                echo $form->field($model, 'floors')->dropDownList($items,$params)->label(false);?>
                <?$items = [
                    'Не нужен, есть или уже строится' => 'Не нужен, есть или уже строится',
                    'Ленточный' => 'Ленточный   ',
                    'Свайно-винтовой' => 'Свайно-винтовой',
                    'Столбчатый' => 'Столбчатый',
                ];
                $params = [
                    'prompt' => 'Нужен ли фундамент?...'
                ];
                echo $form->field($model, 'basement')->dropDownList($items,$params)->label(false);?>
            </div>
        </div>
        <div class="row calc-section">
            <h3 class="title-underblock custom">Что необходимо дополнительно к дому:</h3>
            <div class="col-md-3 sky-form">
                <? echo $form->field($model, 'garage')->checkbox([
                    'label' => '<i></i>Гараж',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
                <? echo $form->field($model, 'bathhouse')->checkbox([
                    'label' => '<i></i>Баня',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
                <? echo $form->field($model, 'pavilion')->checkbox([
                    'label' => '<i></i>Беседка',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
                <? echo $form->field($model, 'well')->checkbox([
                    'label' => '<i></i>Колодец',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
            </div>
            <div class="col-md-3 sky-form">
                <? echo $form->field($model, 'hangar')->checkbox([
                    'label' => '<i></i>Сарай',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
                <? echo $form->field($model, 'boiler_room')->checkbox([
                    'label' => '<i></i>Котельная',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
                <? echo $form->field($model, 'chopped_terrace')->checkbox([
                    'label' => '<i></i>Рубленная терраса',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
                <? echo $form->field($model, 'porch')->checkbox([
                    'label' => '<i></i>Крыльцо',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
            </div>
            <div class="col-md-3 sky-form">
                <? echo $form->field($model, 'balcony')->checkbox([
                    'label' => '<i></i>Балкон',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
                <? echo $form->field($model, 'oriel')->checkbox([
                    'label' => '<i></i>Эркер',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
                <? echo $form->field($model, 'chopped_gables')->checkbox([
                    'label' => '<i></i>Рубленые фронтоны',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
                <? echo $form->field($model, 'fifth_wall')->checkbox([
                    'label' => '<i></i>Пятая стена',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
            </div>
            <div class="col-md-3 sky-form">
                <? echo $form->field($model, 'second_light')->checkbox([
                    'label' => '<i></i>Второй свет',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
                <? echo $form->field($model, 'prostrozhka_plane')->checkbox([
                    'label' => '<i></i>Обработка рубанком',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
                <? echo $form->field($model, 'antiseptic')->checkbox([
                    'label' => '<i></i>Обр-ка антисептиком',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
                <? echo $form->field($model, 'sixth_wall')->checkbox([
                    'label' => '<i></i>Шестая стена',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
            </div>
        </div>
        <div class="row calc-section">
            <h3 class="title-underblock custom">Что уже есть на участке:</h3>
            <div class="col-md-4 sky-form">
                <? echo $form->field($model, 'light')->checkbox([
                    'label' => '<i></i>Свет',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
                <? echo $form->field($model, 'water')->checkbox([
                    'label' => '<i></i>Вода',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
            </div>
            <div class="col-md-4 sky-form">
                <? echo $form->field($model, 'cabins')->checkbox([
                    'label' => '<i></i>Жилье для строителей (бытовка)',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
                <? echo $form->field($model, 'shop')->checkbox([
                    'label' => '<i></i>Магазин поблизости',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
            </div>
            <div class="col-md-4 sky-form">
                <? echo $form->field($model, 'nothing')->checkbox([
                    'label' => '<i></i>Ничего нет',
                    'labelOptions' => [
                        'class' => 'checkbox'
                    ],
                ]);?>
            </div>
        </div>
        <div class="row calc-section">
            <div class="col-md-6">
                    <? echo $form->field($model, 'name')->textInput(['placeholder' => 'Ваше имя','class'=>'form-control no-radius'])->label(false) ;?>
                    <? echo $form->field($model, 'email')->textInput(['placeholder' => 'Ваш E-mail','class'=>'form-control no-radius'])->label(false) ;?>
                    <? echo $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                            'mask' => '+7 (999) 999-99-99',
                            'options' => [
                                'class'=>'form-control no-radius',
                                'placeholder' => '+7(999)999-99-99',
                            ]

                        ])->label(false) ;?>
            </div>
            <div class="col-md-6">
                <? echo $form->field($model, 'body')->textarea(['placeholder' => 'Комментарий к заявке на расчет стоимости', 'rows' => 7,'class'=>'form-control no-radius'])->label(false) ;?>
            </div>
        </div>



        <? echo $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
        ])?>

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

        <? ActiveForm::end();
    }
    
    Pjax::end();?>
        <div class="personal_dan">
            <a href="/documents/personal_dan.pdf" target="_blank">Согласие на обработку персональных данных</a>
        </div>
    </div>
