<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TagsHasItem */

$this->title = $model->tags_id;
$this->params['breadcrumbs'][] = ['label' => 'Tags Has Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tags-has-item-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'tags_id' => $model->tags_id, 'item_id' => $model->item_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'tags_id' => $model->tags_id, 'item_id' => $model->item_id], [
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
            'tags_id',
            'item_id',
        ],
    ]) ?>

</div>
