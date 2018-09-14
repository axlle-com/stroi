<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DetailsHasType */

$this->title = 'Create Details Has Type';
$this->params['breadcrumbs'][] = ['label' => 'Details Has Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="details-has-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
