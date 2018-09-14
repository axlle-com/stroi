<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Extra */

$this->title = 'Create Extra';
$this->params['breadcrumbs'][] = ['label' => 'Extras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="extra-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
