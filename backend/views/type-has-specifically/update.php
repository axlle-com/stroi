<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TypeHasSpecifically */

$this->title = 'Update Type Has Specifically: ' . $model->type_id;
$this->params['breadcrumbs'][] = ['label' => 'Type Has Specificallies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->type_id, 'url' => ['view', 'type_id' => $model->type_id, 'specifically_id' => $model->specifically_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="type-has-specifically-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
