<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\InfoblockHasItem */

$this->title = 'Update Infoblock Has Item: ' . $model->infoblock_id;
$this->params['breadcrumbs'][] = ['label' => 'Infoblock Has Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->infoblock_id, 'url' => ['view', 'infoblock_id' => $model->infoblock_id, 'item_id' => $model->item_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="infoblock-has-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
