<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Specifically */

$this->title = 'Create Specifically';
$this->params['breadcrumbs'][] = ['label' => 'Specificallies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specifically-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
