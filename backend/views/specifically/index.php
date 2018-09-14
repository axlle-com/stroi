<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\Specifically;
/* @var $this yii\web\View */
/* @var $searchModel common\models\Search\SpecificallySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Specificallies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specifically-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Specifically', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'specialty',
            //'extra_id',
            [
                'attribute'=>'extra_id',
                'label'=>'Наценка',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getExtraName();
                },
                'filter' => Specifically::getExtraList(),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
