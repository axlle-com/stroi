<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Semantico */

$this->title = 'Create Semantico';
$this->params['breadcrumbs'][] = ['label' => 'Semanticos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="semantico-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
