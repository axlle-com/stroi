<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Infoblock */

$this->title = 'Create Infoblock';
$this->params['breadcrumbs'][] = ['label' => 'Infoblocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="infoblock-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
