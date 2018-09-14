<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Specifically */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Specificallies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specifically-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'extra_id' => $model->extra_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'extra_id' => $model->extra_id], [
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
            'specialty',
            'extra_id',
        ],
    ]) ?>

</div>
