<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FolderHasItem */

$this->title = 'Create Folder Has Item';
$this->params['breadcrumbs'][] = ['label' => 'Folder Has Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folder-has-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
