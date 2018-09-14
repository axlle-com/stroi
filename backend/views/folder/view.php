<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Folder */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Folders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folder-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description',
            'link',
            'show_img',
            'watermark',
            'small_img',
            'tumb_img',
            'general_photo',
        ],
    ]) ?>

</div>
