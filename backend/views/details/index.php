<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\components\Common;
use common\models\Item;
use common\models\Details;
/* @var $this yii\web\View */
/* @var $searchModel common\models\Search\DetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="details-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Details', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'item_id',
            [
                'attribute'=>'item_id',
                'label'=>'Статья',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getItemName();
                },
                'filter' => Details::getItemList(),
            ],
            'name',
            //'same_item',
            [
                'attribute'=>'same_item',
                'label'=>'Похожая статья',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return $data->getSameItemName();
                },
                'filter' => Details::getItemList(),
            ],


            'material',


            //'initial_size',
            // 'square',
            'room',
            // 'floor',
            // 'mansard',
            // 'balcony',
            // 'krilco',
            // 'garage',
            // 'erker',
            // 'dacha',
            // 'original_price',
            // 'time_build',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
