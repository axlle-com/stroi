<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Render */

$this->title = 'Create Render';
$this->params['breadcrumbs'][] = ['label' => 'Renders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="render-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
