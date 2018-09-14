<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TypeHasSpecifically */

$this->title = 'Create Type Has Specifically';
$this->params['breadcrumbs'][] = ['label' => 'Type Has Specificallies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-has-specifically-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
