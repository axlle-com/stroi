<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TagsHasItem */

$this->title = 'Update Tags Has Item: ' . $model->tags_id;
$this->params['breadcrumbs'][] = ['label' => 'Tags Has Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tags_id, 'url' => ['view', 'tags_id' => $model->tags_id, 'item_id' => $model->item_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tags-has-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
