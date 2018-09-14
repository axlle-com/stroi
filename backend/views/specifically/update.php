<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Specifically */

$this->title = 'Update Specifically: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Specificallies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id, 'extra_id' => $model->extra_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="specifically-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
