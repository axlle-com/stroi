<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DetailsHasType */

$this->title = $model->details_id;
$this->params['breadcrumbs'][] = ['label' => 'Details Has Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="details-has-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'details_id' => $model->details_id, 'type_id' => $model->type_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'details_id' => $model->details_id, 'type_id' => $model->type_id], [
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
            'details_id',
            'type_id',
        ],
    ]) ?>

</div>
