<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\InfoblockHasItem */

$this->title = 'Create Infoblock Has Item';
$this->params['breadcrumbs'][] = ['label' => 'Infoblock Has Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="infoblock-has-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
