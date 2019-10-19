<?php

use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Html;



?>

<?Pjax::begin([
    // Pjax options
]);?>
    <h4>Новости</h4>
    <div class="newsletter-widget">
        <p>Подписавшись на нашу рассылку, вы всегда будете в курсе новостей.</p>

        <?php if (Yii::$app->session->hasFlash('messageSubscribe'))
        {
            $success = Yii::$app->session->getFlash('messageSubscribe');
            echo \yii\bootstrap\Alert::widget([
                'options' => [
                    'class' => 'alert-success'
                ],
                'body' => $success
            ]);
        }else
        {
            $form = ActiveForm::begin([
                'options' => [
                    'enableAjaxValidation' => true,
                    'validationUrl' => \yii\helpers\Url::to(['/validate/subscribe']),
                    'data' => ['pjax' => true],
                    'id' => 'newsletter-widget-form',
                ],
                // остальные опции ActiveForm
            ]);?>

            <?= $form->field($model, 'email')->textInput(['placeholder' => 'Введите ваш Email','class'=>'form-control'])->label(false);?>
            <?= Html::submitButton('<i class="fa fa-envelope"></i>', ['class' => 'btn btn-custom', 'name' => 'submit']) ?>
            <?php ActiveForm::end();
            }?>
    </div><!-- End .newsletter-widget -->



<?Pjax::end();?>