<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Ips */

$this->title = 'Create Ips';
$this->params['breadcrumbs'][] = ['label' => 'Ips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ips-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
