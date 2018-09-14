<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\FolderHasItem */

$this->title = $model->folder_id;
$this->params['breadcrumbs'][] = ['label' => 'Folder Has Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folder-has-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'folder_id' => $model->folder_id, 'item_id' => $model->item_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'folder_id' => $model->folder_id, 'item_id' => $model->item_id], [
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
            'folder_id',
            'item_id',
        ],
    ]) ?>

</div>
