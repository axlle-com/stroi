<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DetailsHasType */

$this->title = 'Update Details Has Type: ' . $model->details_id;
$this->params['breadcrumbs'][] = ['label' => 'Details Has Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->details_id, 'url' => ['view', 'details_id' => $model->details_id, 'type_id' => $model->type_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="details-has-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
