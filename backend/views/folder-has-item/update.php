<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FolderHasItem */

$this->title = 'Update Folder Has Item: ' . $model->folder_id;
$this->params['breadcrumbs'][] = ['label' => 'Folder Has Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->folder_id, 'url' => ['view', 'folder_id' => $model->folder_id, 'item_id' => $model->item_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="folder-has-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
