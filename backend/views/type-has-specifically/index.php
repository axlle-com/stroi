<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\Search\TypeHasSpecificallySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Type Has Specificallies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-has-specifically-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Type Has Specifically', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'type_id',
            [
                'attribute'=>'type_id',
                'label'=>'Тип',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getTypeName();
                },
                'filter' => \common\models\TypeHasSpecifically::getTypeList()
            ],

            //'specifically_id',
            [
                'attribute'=>'specifically_id',
                'label'=>'Допы',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getSpecName();
                },
                'filter' => \common\models\TypeHasSpecifically::getSpecList()
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
