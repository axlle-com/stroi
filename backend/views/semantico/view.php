<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Semantico */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Semanticos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="semantico-view">

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
            'category_id',
            'item_id',
            'key_name',
            'title',
            'title_seo',
            'description:ntext',
            'description_seo',
        ],
    ]) ?>

</div>
