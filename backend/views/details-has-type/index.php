<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\DetailsHasType;
/* @var $this yii\web\View */
/* @var $searchModel common\models\Search\DetailsHasTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Details Has Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="details-has-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Details Has Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'details_id',
            [
                'attribute'=>'details_id',
                'label'=>'Детали',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getDetailsName();
                },
                'filter' => DetailsHasType::getDetailsList()
            ],

            //'type_id',
            [
                'attribute'=>'type_id',
                'label'=>'Тип',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getTypeName();
                },
                'filter' => DetailsHasType::getTypeList()
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
