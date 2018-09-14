<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TagsHasItem */

$this->title = 'Create Tags Has Item';
$this->params['breadcrumbs'][] = ['label' => 'Tags Has Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tags-has-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
