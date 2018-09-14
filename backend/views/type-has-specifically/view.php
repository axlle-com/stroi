<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TypeHasSpecifically */

$this->title = $model->type_id;
$this->params['breadcrumbs'][] = ['label' => 'Type Has Specificallies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-has-specifically-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'type_id' => $model->type_id, 'specifically_id' => $model->specifically_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'type_id' => $model->type_id, 'specifically_id' => $model->specifically_id], [
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
            'type_id',
            'specifically_id',
        ],
    ]) ?>

</div>
