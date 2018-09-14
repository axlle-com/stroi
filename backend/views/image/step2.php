<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Обновить: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Изделия', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>

    <h1><?= Html::encode($this->title) ?></h1>
<?php $form = \yii\bootstrap\ActiveForm::begin(); ?>
<div class="container">
    <div class="row">
        <?
        echo $form->field($model, 'general_photo')->widget(\kartik\file\FileInput::classname(),[
            'options' => [
                'accept' => 'image/*',
            ],
            'pluginOptions' => [
                'uploadUrl' => \yii\helpers\Url::to(['file-upload-general']),
                'uploadExtraData' => [
                    'id' => $model->id,
                ],
                'allowedFileExtensions' =>  ['jpg', 'png','gif'],
                'initialPreview' => $image,
                'showUpload' => true,
                'showRemove' => false,
                'dropZoneEnabled' => false
            ]
        ]);
        ?>
    </div>


<br><br>
    <div class="form-group">
        <?= \yii\helpers\Html::submitButton($model->isNewRecord ? 'Записать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php \yii\bootstrap\ActiveForm::end(); ?>
</div>
    